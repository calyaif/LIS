<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #000;
        }
        .header-laporan {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header-laporan h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }
        .header-laporan p {
            margin: 4px 0 0 0;
            font-size: 12px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th {
            background-color: #343a40;
            color: #fff;
            padding: 8px;
            text-align: left;
            border: 1px solid #999;
            font-size: 11px;
        }
        table td {
            padding: 6px 8px;
            border: 1px solid #ccc;
            vertical-align: top;
            font-size: 11px;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .tombol-cetak {
            text-align: right;
            margin-bottom: 15px;
        }
        .tombol-cetak button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 20px;
            font-size: 13px;
            border-radius: 4px;
            cursor: pointer;
        }
        .tombol-cetak button:hover {
            background-color: #c82333;
        }
        @media print {
            .tombol-cetak {
                display: none;
            }
            body {
                margin: 10px;
            }
            table th {
                background-color: #343a40 !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    <div class="tombol-cetak">
        <button onclick="window.print()">
            &#128438; Cetak / Simpan sebagai PDF
        </button>
    </div>

    <div class="header-laporan">
        <h2>Laporan Data Member</h2>
        <p>Library Information System</p>
        <p>Dicetak pada: <?= date('d F Y, H:i') ?> WIB</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="40">No.</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Alamat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0; ?>
            <?php foreach($members as $member): ?>
                <?php $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    
                    <td><?= $member['nama'] ?? '-' ?></td>
                    <td><?= $member['email'] ?? '-' ?></td>
                    <td><?= $member['kontak'] ?? '-' ?></td>
                    
                    <td>Tidak Ada Alamat</td> 
                    
                    <td><?= $member['status'] ?? '-' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>