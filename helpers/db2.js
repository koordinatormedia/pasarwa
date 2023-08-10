const mysql = require('mysql2/promise');
const config = require('./config');

async function query(params) {
  const connection = await mysql.createConnection(config.db);
  const [results, ] = await connection.execute('SELECT pesan from pesan_otomatis WHERE kata = ?' , [params]);
  return results[0].pesan;
}
/* async function insertpesan(pengirim, pesan) {
  const connection = await mysql.createConnection(config.db);
  const [result, ] = await connection.execute('insert into pesan_masuk(pengirim,pesan,waktu) values (?,?,now()) ', [pengirim,pesan],);

  //return results[0].pesan;
} */

module.exports = {
  query
}
		