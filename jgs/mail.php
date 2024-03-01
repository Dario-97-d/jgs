<?php include("header.php");
if(!isset($_SESSION['uid'])){exiter("index");}
if(isset($_POST['pmdel'])){
	$pmidel=prot($conn,$_POST['pmdel']);
	$delpm=sql_query($conn,"DELETE FROM mailbox WHERE pmid=$pmidel");
	output("PM deleted");
}?>
<h1>Entry</h1>
<?php $getpms=sql_query($conn,"SELECT m.*,u.id FROM mailbox m LEFT JOIN users u ON m.pmfrom=u.username WHERE pmto='".$username."' ORDER BY time DESC");
if(mysqli_num_rows($getpms)<1){output("Mailbox is empty.");}
else{
	while($pms=mysqli_fetch_assoc($getpms)){
		echo '<b>From:</b> <a href="op?id='.$pms['id'].'">'.$pms['pmfrom']."</a><br /><b>";
		echo date("d/m H:i:s",$pms['time'])."</b>";
		echo '<div id="msg">'.nl2br($pms['pmtext'])."</div>";
		echo ($pms['seen']==0?'<span style="color: #204080;padding:5px;"><b>New</b></span>':'');}?>
	<table>
		<td>
			<form action="mp" method="POST">
				<input type="submit" class="button1" value="Reply"/>
				<input type="hidden" name="pmto" value="<?php echo $pms['pmfrom']; ?>"/>
			</form>
		</td>
		<td>
			<form action="mr" method="POST">
				<input type="submit" class="button1" value="Delete"/>
				<input type="hidden" name="pmdel" value="<?php echo $pms['pmid']; ?>"/>
			</form>
		</td>
	</table>
	<?php
}
$pmseen=sql_query($conn,"UPDATE mailbox SET seen=1 WHERE pmto='".$username."'");
include("footer.php");?>