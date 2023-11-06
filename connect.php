<?php
$name = $_POST['name'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$city = $_POST['city'];

class Info{
    public int $id;
    public string $name;
    
    public string $email;
    
    public string $gender;

    public string $city;
}

//Database Connection
$conn = new mysqli('localhost','root','','asgn');

if($conn->connect_error){
    die('Connection Failed. '. $conn->connect_error);
}
else{
    $st = $conn->prepare("insert into registration(name,email,gender,city) values(?,?,?,?)");
    $st->bind_param("ssss", $name,$email,$gender,$city);
    $st->execute();
    $st->close();
    $conn->close();

    $pdo = new PDO('mysql:host=127.0.0.1;dbname=asgn','root','');
    $statement = $pdo->prepare('select * from registration');//prepares query to be fired
//object statement mei aa jayega

    $statement->execute();
    
    $info=$statement->fetchAll(PDO::FETCH_CLASS,'Info');
        echo '<center><table border = "2" ><tr>';
    foreach($info as $i){
        echo '<td>'.$i->id.'</td><td>'.$i->name.'</td><td>'.$i->email;
        echo '</td><td>'.$i->gender.'</td><td>'.$i->city;'</td>';
        echo '</tr>';
    }
    echo '</table><br><a href="form.html">Add more Data</a></center>';

}
?>