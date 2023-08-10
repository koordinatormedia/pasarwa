const mysql = require('mysql2/promise');

const createConnection = async()=> {
	return await mysql.createConnection({
		host: 'localhost',
		user: 'root',
		password:'',
		database: 'waq',
		connectionLimit: '50',
	});
}
const getReply = async(keyword) => {
	const connection = await createConnection();
	const [rows] = await connection.execute('SELECT pesan from pesan_otomatis WHERE kata = ?' ,[keyword]);
	if (rows.length > 0) return rows[0].pesan;
	return false;
}

const insertpesan = async(pengirim,inbox) => {
	
	const connection = await createConnection();
	const [rows] = await connection.execute('insert into pesan_masuk(pengirim,pesan,waktu) values (?,?,now()) ', [pengirim,inbox]);
	/* if (rows.length > 0) return rows[0].pesan;
	return false; */
}
const cronjadwal = async()=> {
$count = 0;
$now = strtotime(date("Y-m-d H:i:s"));
$chunk = 100;
const connection = await createConnection();
const [rows] = await connection.execute('SELECT * FROM pesan WHERE status="MENUNGGU JADWAL" ORDER BY id ASC LIMIT 100 ');
for (let i = 0; i < rows.length; i++) {
    const jadwal = strtotime(rows['jadwal']);
    if ($jadwal < $now) { 

        $nomor = $rows['nomor'];
        $pesan = utf8_decode($rows['pesan']);

        if ($rows['media'] == null) {
            $send = sendMsg1($nomor, $pesan);
            if ($send['status'] == "true") {
                $i++;
                $this_id = rows['id'];
                const [updated] = await connection.execute('UPDATE pesan SET status = "TERKIRIM" WHERE id="$this_id" ');
            } else {
                $s = false;
            }
            sleep(1);
        }
    }
    
}

}
module.exports = {
	createConnection,
	getReply,
	insertpesan,
	cronjadwal
}
		