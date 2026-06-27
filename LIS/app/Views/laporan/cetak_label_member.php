<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: #f4f6f9; 
            padding: 20px;
        }
        .action-buttons { 
            text-align: center; 
            margin-bottom: 30px; 
        }
        .btn { 
            padding: 10px 20px; 
            border: none; 
            border-radius: 5px; 
            color: white; 
            cursor: pointer; 
            font-weight: bold; 
            margin: 0 5px; 
            font-size: 13px;
        }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        
        /* GRID UNTUK BANYAK KARTU BIAR BERJAJAR RAPI */
        .grid-kartu {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        /* DESAIN KARTU PERSIS KAYAK SING SATUAN */
        .id-card { 
            width: 350px; 
            background: white; 
            border-radius: 6px; 
            box-shadow: 0 6px 12px rgba(0,0,0,0.15); 
            overflow: hidden; 
            border: 1px solid #1a365d; 
        }
        .card-header { 
            background: #1a365d; 
            color: white; 
            text-align: center; 
            padding: 12px; 
            font-weight: bold; 
            font-size: 14px; 
            letter-spacing: 1px; 
        }
        .card-body { 
            padding: 25px 30px; 
            text-align: center; 
        }
        .card-name { 
            font-size: 18px; 
            font-weight: bold; 
            text-transform: uppercase; 
            margin-bottom: 15px; 
            color: #1a365d; 
        }
        hr { 
            border: 0; 
            border-top: 2px solid #e2e8f0; 
            margin-bottom: 15px; 
        }
        .card-details { 
            text-align: left; 
            font-size: 13px; 
            line-height: 2; 
            color: #333; 
        }
        .detail-row { display: flex; }
        .detail-label { width: 70px; font-weight: bold; }
        .detail-value { flex: 1; }
        .card-footer { 
            text-align: center; 
            font-size: 9px; 
            color: #777; 
            padding: 12px; 
            background: #f8f9fa; 
            border-top: 1px solid #e2e8f0; 
            text-transform: uppercase;
        }
        
        /* SETTINGAN PRINTER BIAR GAK KEPOTONG */
        @media print {
            body { background: white; margin: 0; padding: 0; }
            .action-buttons { display: none; }
            .id-card { box-shadow: none; border: 1px solid #000; page-break-inside: avoid; margin-bottom: 20px;}
            .card-header { 
                background: #1a365d !important; 
                color: white !important; 
                -webkit-print-color-adjust: exact; 
                print-color-adjust: exact; 
            }
        }
    </style>
</head>
<body>

    <div class="action-buttons">
        <button class="btn btn-danger" onclick="window.print()">🖨️ Cetak Semua / Simpan PDF</button>
        <button class="btn btn-secondary" onclick="window.close()">✖ Tutup</button>
    </div>

    <div class="grid-kartu">
        <?php foreach($members as $member): ?>
            <div class="id-card">
                <div class="card-header">
                    💳 KARTU ANGGOTA PERPUSTAKAAN
                </div>
                <div class="card-body">
                    
                    <div class="card-name"><?= is_array($member) ? $member['nama'] : $member->nama ?></div>
                    
                    <hr>
                    <div class="card-details">
                        <div class="detail-row">
                            <div class="detail-label">Email</div>
                            <div class="detail-value">: <?= is_array($member) ? $member['email'] : $member->email ?></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Kontak</div>
                            <div class="detail-value">: <?= is_array($member) ? $member['kontak'] : $member->kontak ?></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Status</div>
                            <div class="detail-value">: <?= is_array($member) ? $member['status'] : $member->status ?></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    LIBRARY INFORMATION SYSTEM — Berlaku selama menjadi anggota aktif
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>