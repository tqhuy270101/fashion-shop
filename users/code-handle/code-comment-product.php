
<?php 
	$conn = mysqli_connect("localhost","root","","demo");
	$noidung = $_POST['content'];
	$id = $_POST['idbook'];
	$idnguoidung = $_POST['iduser'];
	$rating = $_POST['rate'];
	$sql = "INSERT into binhluan (idsach, noidung, idnguoidung, star) values($id, '$noidung', $idnguoidung, $rating)";
	$ketqua = mysqli_query($conn, $sql);
//xu ly binh luan da co j dau doi co sao :V bua co them mak xoa r :V hop li
 ?>


