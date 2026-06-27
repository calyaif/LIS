<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #e2e8f0; /* Background abu-abu agar kartu menonjol saat di layar */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .wrapper {
            position: relative;
        }
        
        /* DESAIN STANDAR ID CARD (KTP/ATM) */
        .id-card {
            width: 85.6mm; 
            height: 53.98mm; 
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
        }

        /* Bagian Atas Kartu (Header Biru Tua) */
        .card-header {
            background: #1e293b; 
            color: #ffffff;
            text-align: center;
            padding: 8px 0;
            border-bottom: 3px solid #3b82f6; /* Garis aksen biru muda */
        }
        .card-header h2 {
            margin: 0;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 1px;
        }
        .card-header p {
            margin: 2px 0 0;
            font-size: 8px;
            color: #94a3b8;
            text-transform: uppercase;
        }

        /* Bagian Isi Kartu */
        .card-body {
            display: flex;
            padding: 10px 12px;
            flex: 1;
            align-items: center;
        }
        
        /* Kotak Pas Foto */
        .photo-box {
            width: 55px;
            height: 70px;
            background: #f1f5f9;
            border: 2px dashed #cbd5e1;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 10px;
            color: #64748b;
            text-align: center;
            font-weight: bold;
        }

        /* Teks Identitas */
        .details {
            flex: 1;
        }
        .details h3 {
            margin: 0 0 6px 0;
            font-size: 13px;
            color: #0f172a;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 4px;
            text-transform: uppercase;
        }
        .detail-row {
            display: flex;
            margin-bottom: 3px;
            font-size: 10px;
            color: #334155;
        }
        .detail-label {
            width: 45px;
            font-weight: bold;
        }
        .detail-value {
            flex: 1;
        }

        /* Bagian Bawah Kartu */
        .card-footer {
            background: #f1f5f9;
            text-align: center;
            padding: 4px;
            font-size: 8px;
            font-weight: bold;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }

        /* Tombol Print Melayang */
        .btn-print {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            background: #ef4444;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn-print:hover { background: #dc2626; }

        /* MENGATUR TAMPILAN SAAT MASUK KE MESIN PRINTER */
        @media print {
            body {
                background: white;
                height: auto;
                margin: 0;
                padding: 0;
            }
            .btn-print { display: none; } /* Sembunyikan tombol saat dicetak */
            .id-card {
                box-shadow: none;
                border: 1px solid #000;
                /* Memaksa ukuran asli saat diprint */
                width: 85.6mm;
                height: 53.98mm;
                page-break-inside: avoid;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <button class="btn-print" onclick="window.print()">🖨️ Cetak Kartu Ini</button>
        
        <div class="id-card">
            
            <div class="card-header">
                <h2>KARTU ANGGOTA</h2>
                <p>Library Information System</p>
            </div>
            
            <div class="card-body">
                <div class="photo-box">
                    FOTO<br>3x4
                </div>
                <div class="details">
                    <h3><?= $member['nama'] ?></h3>
                    
                    <div class="detail-row">
                        <div class="detail-label">ID</div>
                        <div class="detail-value">: <?= $member['id_member'] ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Email</div>
                        <div class="detail-value">: <?= $member['email'] ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Kontak</div>
                        <div class="detail-value">: <?= $member['kontak'] ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">: <?= $member['status'] ?></div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                Kartu ini tidak boleh dipindahtangankan
            </div>
            
        </div>
    </div>

</body>
</html>