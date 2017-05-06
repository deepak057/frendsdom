var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var mysql      = require('mysql');
var db_config={user:'root',password:'6%hHByeMdSC=A=3E',database:'omapp',host:'localhost'};

 var connection = mysql.createConnection(db_config);
connection.connect();

app.get('/', function(req, res){
  res.sendfile('index.html');
});

//Whenever someone connects this gets executed
io.on('connection', function(socket){
  console.log('A user connected');

 


socket.on("send",function(data){

data=JSON.parse(data);

connection.query("update  users set current_location='"+JSON.stringify(data.location)+"' where `id` ='"+data.uid+"'" ,function(err,rows,fields){
if(err)console.log(err);

else 
{
console.log("Updated for users "+data.uid);
}


}

});

  //Whenever someone disconnects this piece of code executed
 socket.on('disconnect', function () {
    console.log('A user disconnected');
  });

    /*socket.on('i am client', function(data){

console.log(data.id);
});
*/
/*
socket.on('message',function(data){

socket.emit("message",data);

console.log(data);
});    

*/

});

http.listen(3000, function(){
  console.log('listening on *:3000');
});
