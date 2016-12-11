var pg = require(‘pg’);

var connectionString = "postgres://postgres:bibs1423@localhost/ip:5432/db";

var pgClient = new pg.Client(connectionString);

pgClient.connect();

var query = pgClient.query("SELECT * FROM emp"); 



document.getElementById("dbresult").innerHTML = "New text!";







