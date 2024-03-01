<?php include("header.php");
if(!isset($_SESSION['uid'])){exiter("index");}?>
<h1>Mail Sent</h1>
<?php
if(isset($_POST['pmdel'])){
	$pmidel=(ctype_digit($_POST['pmdel'])?$_POST['pmdel']:'');
	$delpm=sql_query($conn,"DELETE FROM mailbox WHERE pmid=$pmidel");
	output("PM deleted");
}
$getpms=sql_query($conn,"SELECT m.*,u.id FROM mailbox m LEFT JOIN users u ON m.pmto=u.username WHERE pmfrom='".$username."' ORDER BY time DESC");
if(mysqli_num_rows($getpms)<1){output("No messages at the moment.");}
else{
	while($pms=mysqli_fetch_assoc($getpms)){
		echo '<b>Sent to:</b> <a href="op?id='.$pms['id'].'">'.$pms['pmto']."</a><br /><b>"
		.date("d/m H:i:s",$pms['time']).'</b>
		<div id="msg">'.nl2br($pms['pmtext'])."</div>";
		echo ($pms['seen']==0?'<span style="color: #204080; padding: 5px;"><b>Not Seen</b></span>':'');?>
		<table>
			<td>
				<form action="mr" method="POST">
					<input type="submit"class="button1" value="Delete"/>
					<input type="hidden" name="pmdel" value="<?php echo $pms['pmid']; ?>"/>
				</form>
			</td>
			<td>
				<form action="mp" method="POST">
					<input type="submit" class="button1" value="New PM"/>
					<input type="hidden" name="pmto" value="<?php echo $pms['pmto']; ?>"/>
				</form>
			</td>
		</table>
		<?php
	}
}
include("footer.php");?>