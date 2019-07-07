<?php
    $pdf = new Pdf_oc('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('ORDER CONFIRMATION');
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
        
        </head>
        <body>
            <table>
                <tr>
                    <td style="width:300">PT INDONESIA CHEMICAL ALUMINA</td>
                    <td style="text-align:right; width:200">Kamis, 23 Juni 2019</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Jl. Trans Kalimantan, Dusun Piasak</td>
                </tr>
                <tr>
                    <td>Desa Pedalaman Kecamatan Tayan Hilir</td>
                </tr>
                <tr>
                    <td>Kabupaten Sanggau, Kalimantan Barat 78564</td>
                </tr>
            </table>
<br><br>
            <table>
                <tr>
                    <th style="text-align:center; font-size:22pt; font-weight:bold;text-decoration:underline"><b>Order Konfirmasi</b></th>
                </tr>
                <tr>
                    <th style="text-align:center; font-size:16pt;">LI20190613</th>
                </tr>
            </table>
            <br><br><br>
            <table>
                <tr>
                    <td style="width: 190px">Salesman</td>
                    <td>: Robert Cau (Bob@leiter.co.id)</td>
                </tr>
                <tr>
                    <td>Nomor PO</td>
                    <td>: 5000005898</td>
                </tr>
            </table>
            <br>
            <br>
            <table>
                <tr>
                    <td>Dear Bapak / Ibu yang kami hormati,</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td>Kami mengucapkan terima kasih untuk order yang telah kami terima pada tanggal 31 Mei 2019.
                    </td>
                </tr>    
                <tr>
                    <td>Berikut adalah surat konfirmasi untuk pemesanan barang yang telah kami terima :
                    </td>
                </tr>
            </table>
            <br><br>
            <table  border="1" style="border-collapse:collapse">
                <tr>
                    <th style="text-align:center; font-weight:bold; width:26px;">No.</th>
                    <th style="text-align:center; font-weight:bold; width:240px;">Deskripsi</th>
                    <th style="text-align:center; font-weight:bold; width:70px;">Qty</th>
                    <th style="text-align:center; font-weight:bold; width:100px;">Harga (IDR)</th>
                    <th style="text-align:center; font-weight:bold; width:100px;">Jumlah (IDR)</th>
                </tr>';

                
                $baris="LEITER FILTER CLOTH
                GRADE : LI-01-PP520-KS
                MATERIAL : POLYPROPYLENE
                TYPE OF FIBERS : MONO
                WITH (cm) : 218/234
                WEIGHT (g/m2) : 280
                AIR PERMEABILITY (L/dm2/mnt) ; 6.6-25
                BUBBLE POINT (um) ; 25c";

                $split = explode("\n",$baris);
                $jumlah_baris = count($split);
                $line_height = round($jumlah_baris * 12.5);

                $content= $content.'
                <tr>
                    <td style="text-align:center;height:20px;line-height:'.$line_height.'px;">1</td>
                    <td>'. nl2br($baris).'
                    </td>
                    <td style="text-align:center;height:20px;line-height:'.$line_height.'px;">320pcs</td>
                    <td style="text-align:center;height:20px;line-height:'.$line_height.'px;">3,500,000</td>
                    <td style="text-align:center;height:20px;line-height:'.$line_height.'px;">1,120,000,000</td>
                </tr>
            </table>
            <br><br><br>
            <table>
                <tr>
                    <td style="width: 190px">Penyerahan Barang</td>
                    <td style="width:6px;">: </td>
                    <td style="width:340px;">Franco Tayan</td>
                </tr>
                <tr>
                    <td>Metode Pengiriman</td>
                    <td style="width:6px;">: </td>
                    <td>BY SEA</td>
                </tr>
                <tr>
                    <td>Tanggal Penyerahan Barang</td>
                    <td style="width:6px;">: </td>
                    <td>12 minggu, setelah PO dikonfirmasi</td>
                </tr>
                <tr>
                    <td>Pembayaran</td>
                    <td style="width:6px;">: </td>
                    <td>50% DP diawal
                    <br>50% pelunasan dalam 2 minggu setelah barang & invoice diterima
                    </td>
                </tr>
            </table>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
                Hormat Kami,
                <br><br><br>
        </body>
        </html>
';
$pdf->writeHTML($content);

$pdf->SetFont('MonotypeCorsivai','', 24);
$content = 'Darus';
$pdf->writeHTML($content); //yang keluarin html nya. Setfont nya harus diatas kontennya

$pdf->SetFont('Tahoma','', 10.5);
$content ='PT LEITER INDONESIA';
$pdf->writeHTML($content);
    //$obj_pdf->SetFont(Courier','', 8); //untuk font, liat dokumentasui
    //$pdf->writeHTML($content); //yang keluarin html nya. Setfont nya harus diatas kontennya
    //$pdf->Write(5, 'Contoh Laporan PDF dengan CodeIgniter + tcpdf');
    $pdf->Output('contoh1.pdf', 'I');
?>