<?php
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
                    <td>Tangerang, 10 Juni 2019</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td style="width:25px; font-weight:bold">No.</td>
                    <td style="font-weight:bold">: LI-485/Quo/VI/2019</td>
                </tr>
                <tr>
                    <td style="width:25px; font-weight:bold">Hal</td>
                    <td style="font-weight:bold">: Penawaran LEITER Nytal</td>
                </tr>
            </table>
        <br><br>
            <table>
                <tr>
                    <td style="font-weight:bold">Kepada Yth.</td>
                </tr>
                <tr>
                    <td>PT WILMAR NABATI INDONESIA</td>
                </tr>
                <tr>
                    <td>Jl. Kapten Darmo Sugondo No.56<br>Gresik 61124
                    </td>
                </tr>    
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td style="width:25px; font-weight:bold">Up</td>
                    <td style="font-weight:bold">: Ibu Devi Novita</td>
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
                    <td>Memenuhi kebutuhan Ibu, dengan ini kami ajukan penawaran harga sebagai berikut :</td>
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
                </tr>
                <tr>
                    <td style="text-align:center">1</td>
                    <td>LLEITER PA 10MF / 132, width 158cm
                    <br>made of LI-0110-132b-158
                    <br>
                    <img src="'.base_url() .'assets/images/product.png" class="producttt">
                    </td>
                    <td  style="text-align:center">200 m</td>
                    <td  style="text-align:center">500,000</td>
                    <td  style="text-align:center">100,000,000</td>
                </tr>
                <tr>
                    <td style="text-align:center">2</td>
                    <td>LLEITER PA 10MF / 132, width 158cm
                    <br>made of LI-0110-132b-158
                    <br>
                    <img src="'.base_url() .'assets/images/product.png" class="producttt">
                    </td>
                    <td  style="text-align:center">200 m</td>
                    <td  style="text-align:center">500,000</td>
                    <td  style="text-align:center">100,000,000</td>
                </tr>
                <tr>
                    <td style="text-align:center">3</td>
                    <td>LLEITER PA 10MF / 132, width 158cm
                    <br>made of LI-0110-132b-158
                    <br>
                    <img src="'.base_url() .'assets/images/product.png" class="producttt">
                    </td>
                    <td  style="text-align:center">200 m</td>
                    <td  style="text-align:center">500,000</td>
                    <td  style="text-align:center">100,000,000</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td style="font-weight:bold; text-align:center">TOTAL</td>
                    <td style="font-weight:bold; text-align:center">203,655,950</td>
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
                    <td>12 minggu setelah PO dikonfirmasi</td>
                </tr>
                <tr>
                    <td style="width:15px"></td>
                    <td style="width:15px">•</td>
                    <td>Franco : Gresik</td>
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
                    <td colspan="2"  style="width:500px">Pembayaran : 2 minggu setelah PO dikonfirmasi</td>
                </tr>
                <tr>
                    <td style="width:15px">3. </td>
                    <td colspan="2" style="width:500px">Harga tersebut di atas dalam Rupiah, <b>belum termasuk PPN 10%</b></td>
                </tr>
                <tr>
                    <td style="width:15px">4. </td>
                    <td colspan="2" style="width:500px">Penawaran kami berlaku sampai dengan tanggal 24 Juni 2019</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">Demikianlah surat penawaran kami ini, sambil menunggu kabar baik berikutnya dari Ibu.<br>Terima kasih atas perhatiannya.
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
?>