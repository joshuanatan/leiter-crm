<?php
foreach($quotation ->result() as $quo){    
    $pdf = new Pdf_oc('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('QUOTATION');
    $pdf->SetTopMargin(30);
    $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true,22);
    $pdf->SetAuthor('Author');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->setPrintHeader(true);
    $pdf->setPrintFooter(true);
    $pdf->AddPage('P','A4');

   
    $fontname = TCPDF_FONTS::addTTFfont('../../../libraries/tcpdf/fonts/tahoma.ttf', 'TrueTypeUnicode', '', 96);
    $pdf->SetFont('Tahoma','', 10.5); //untuk font, liat dokumentasui

    $content='
    <html>
        <head>
            <style>
                .producttt{
                    width: 100px;
                }
            </style>
        </head>
        <body>
            <table>
                <tr>
                    <td>Tangerang, '. tanggalCantik(date("Y/m/j",strtotime($quo->date_quotation_add))) .'</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td style="width:25px; font-weight:bold">No.</td>
                    <td style="font-weight:bold">: '.$quo->no_quotation.'</td>
                </tr>
                <tr>
                    <td style="width:25px; font-weight:bold">Hal</td>
                    <td style="font-weight:bold">: '.$quo->hal_quotation.'</td>
                </tr>
            </table>
        <br><br>
            <table>
                <tr>
                    <td style="font-weight:bold">Kepada Yth.</td>
                </tr>
                <tr>
                    <td>';

                     
                    foreach($perusahaan -> result() as $per){
                        $content = $content . $per->nama_perusahaan;
                    };

                    $content = $content .'</td>
                </tr>
                <tr>
                    <td>'.$quo->alamat_perusahaan.'
                    </td>
                </tr>    
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td style="width:25px; font-weight:bold">Up</td>
                    <td style="font-weight:bold">: '.$quo->up_cp.'</td>
                </tr>
            </table>
            <br><br>
            <table>
                <tr>
                    <td>Dengan hormat,</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td>Memenuhi kebutuhan ';
                    
                    $ibubapak = explode(" ",$quo->up_cp);
                    
                    $content = $content . $ibubapak[0]. ', dengan ini kami ajukan penawaran harga sebagai berikut :</td>
                </tr>
                
            </table>
            <br><br>
            <table  border="1" style="border-collapse:collapse">
                <tr>
                    <th style="text-align:center; font-weight:bold; width:26px;">No.</th>
                    <th style="text-align:center; font-weight:bold; width:240px;">Description</th>
                    <th style="text-align:center; font-weight:bold; width:60px;">Qty</th>
                    <th style="text-align:center; font-weight:bold; width:100px;">Price (IDR)</th>
                    <th style="text-align:center; font-weight:bold; width:100px;">Amount (IDR)</th>
                </tr>';
                
                $no = 0;
                $total=0;
                foreach($items -> result() as $x){
                    $no++;

                    $content = $content . '<tr>
                    <td style="text-align:center">'.$no.'</td>
                    <td>'.nl2br($x->nama_produk_leiter).'
                    <br>
                    <img src="'.base_url() . 'assets/dokumen/quotation/'. $x->attachment .'" class="producttt">
                    </td>
                    <td  style="text-align:center">'. $x->item_amount .' '. $x->satuan_produk.'</td>
                    <td  style="text-align:center">'.number_format($x->selling_price).'</td>
                    <td  style="text-align:center">'.number_format($x->selling_price * $x->item_amount).'</td>
                    </tr>';
                    
                    $total = $total + ($x->selling_price * $x->item_amount);
                }

                
                
                $content = $content .'
                <tr>
                    <td colspan="3"></td>
                    <td style="font-weight:bold; text-align:center">TOTAL</td>
                    <td style="font-weight:bold; text-align:center">'.number_format($total).'</td>
                </tr>
            </table>
            <br><br>
            <table>
                <tr>
                    <td style="text-decoration:underline">Hal-hal lain sehubungan dengan penawaran kami ini adalah :
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td style="width:15px">1. </td>
                    <td colspan="2">Waktu pengiriman barang dalam kondisi normal :</td>
                </tr>
                <tr>
                    <td style="width:15px"></td>
                    <td style="width:15px">•</td>
                    <td>'.$quo->durasi_pengiriman.' minggu setelah PO dikonfirmasi</td>
                </tr>
                <tr>
                    <td style="width:15px"></td>
                    <td style="width:15px">•</td>
                    <td>Franco : '.$quo->franco.'k</td>
                </tr>
                <tr>
                    <td style="width:15px"></td>
                    <td style="width:15px">•</td>
                    <td>Jadwal Produksi : (Senin-Jumat), diluar hari libur</td>
                </tr>
                <tr>
                    <td style="width:15px"></td>
                    <td style="width:15px">•</td>
                    <td>Jadwal Pengiriman : (Senin-Jumat), diluar hari libur
                    </td>
                </tr>
                <tr>
                    <td style="width:15px">2. </td>
                    <td colspan="2"  style="width:500px">Pembayaran : '.$quo->durasi_pembayaran.' minggu setelah PO dikonfirmasi</td>
                </tr>
                <tr>
                    <td style="width:15px">3. </td>
                    <td colspan="2" style="width:500px">Harga tersebut di atas dalam Rupiah, <b>belum termasuk PPN 10%</b></td>
                </tr>
                <tr>
                    <td style="width:15px">4. </td>
                    <td colspan="2" style="width:500px">Penawaran kami berlaku sampai dengan tanggal '.tanggalCantik(date("Y/m/d",strtotime("$quo->dateline_quotation"))).'</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">Demikianlah surat penawaran kami ini, sambil menunggu kabar baik berikutnya dari '.$ibubapak[0].'.<br>Terima kasih atas perhatiannya.
                    </td>
                </tr>

            </table>
            <br>
            <br>
            <br>
            <table>
                <tr>
                    
                    <td style="text-align:left">Hormat Kami,
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                </table>
            </body>
            </html>
    ';
    $pdf->writeHTML($content);

    $pdf->SetFont('MonotypeCorsivai','', 24);
    $content = 'Robert Cau';
    $pdf->writeHTML($content); //yang keluarin html nya. Setfont nya harus diatas kontennya

    $pdf->SetFont('Tahoma','', 10.5);
    $content ='Sales Director (+62811837081)<br>PT LEITER INDONESIA';
$pdf->writeHTML($content);
    //$pdf->Write(5, 'Contoh Laporan PDF dengan CodeIgniter + tcpdf');
    $pdf->Output('contoh1.pdf', 'I');
}
?>