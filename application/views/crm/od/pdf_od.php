<?php
    $pdf = new Pdf_noHead('P', 'mm', 'A5', true, 'UTF-8', false);
    $pdf->SetTitle('ORDER DELIVERY');
    //$pdf->SetTopMargin(30);
    $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true,22);
    $pdf->SetAuthor('Author');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(true);
    $pdf->AddPage('L','A5');

    $fontname = TCPDF_FONTS::addTTFfont('../../../libraries/tcpdf/fonts/tahoma.ttf', 'TrueTypeUnicode', '', 96);
    $pdf->SetFont('Tahoma','', 10.5); //untuk font, liat dokumentasui

    $content='
    <html>
        <head>
        
        </head>
        <body>
            <table>
                <tr>
                    <td style="width:310; font-weight:bold;"><i>PT LEITER INDONESIA</i></td>
                    <td>Kamis, 23 Juni 2019</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Ruko Prominence Alam Sutera 38F / 53-55	
                    <br>Jln. Jalur Sutera Prominence	
                    <br>Alam Sutera, Tangerang 15143 
                    <br>Banten INDONESIA
                    </td>
                    <td><br><br>Kepada Yth.
                    <br>PT. SRIBOGA FLOUR MILL
                    <br>Jl. Deli No. 10 & 23  
                    <br>Pelabuhan Tanjung Emas                            
                    <br>Semarang 50174</td>
                </tr>
            </table>
<br><br>
            <table>
                <tr>
                    <td style="width:120px">Surat Jalan No.</td>
                    <td>: 190697/LI/SJ/19
                    </td>
                </tr>
            </table>
            <br>
            <br>
            <table border="1" align="center">
                <tr>
                    <th style="width:80px; font-weight:bold">Jumlah</th>
                    <th style="width:80px; font-weight:bold">Unit</th>
                    <th style="width:350px; font-weight:bold">Nama Barang</th>
                </tr>
                <tr>
                    <td>50</td>
                    <td>m</td>
                    <td style="text-align:left">
                    PA 11MF / 118 , width 158cm
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align:left">
                    
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align:left">
                    
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align:left">
                    <b>PO No : 1905.07014</b>
                    </td>
                </tr>
            </table>
<br><br><br><br>
            <table align="center">
                <tr>
                    <td>Tanda Terima,</td>
                    <td></td>
                    <td>Hormat Kami,</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Elisa</td>
                </tr>
            </table>
        </body>
    </html>
    ';

    //$obj_pdf->SetFont(Courier','', 8); //untuk font, liat dokumentasui
    $pdf->writeHTML($content); //yang keluarin html nya. Setfont nya harus diatas kontennya
    //$pdf->Write(5, 'Contoh Laporan PDF dengan CodeIgniter + tcpdf');
    $pdf->Output('contoh1.pdf', 'I');
?>