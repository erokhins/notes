<?php
	
	$mainPage = $rootFolder.$login.'/';
	if ($folder == $login.'/') {
		$parentFolder = '';
	} else {
		$parentFolder = $rootFolder.getParentFolder($folder);
	}
	$startFolder = $rootFolder.$folder;
	$allSubfolders = getSubFolders($folder);
	
	$allMessages = getAllMessages($folderId);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Notes</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
    <link href="<?=$rootFolder?>css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?=$rootFolder?>css/bootstrap-glyphicons.css" rel="stylesheet" media="screen">
    <link href="<?=$rootFolder?>css/my.css" rel="stylesheet" media="screen">
    <link href="<?=$rootFolder?>css/my_m.css" rel="stylesheet" media="only screen and (max-device-width: 480px)">
  </head>
  <body onload='$("#new_Mes").focus();'>

	
<div class="container">
	<div class="row">
		<div class="col-lg-3">
			<div class="menu well">
				<a href = "<?=$mainPage?>" class = "main_link text-center">Main page</a>

				<?if($parentFolder != '') {?>
					<a href = "<?=$parentFolder?>">..</a>
				<?}?>	
				<?for($i = 0; $i < sizeOf($allSubfolders); $i++) {
					$subFolder = $allSubfolders[$i];
				?>
					<a href = "<?=$startFolder.$subFolder?>"><?=$subFolder?></a>
				<?}?>
				

			</div>
		</div>
		<div class="col-lg-9">
			<div id="messages" class= "redb">
				<div id = "message_div">
					<table id = "table_messages">
						
						<?for ($i = 0; $i < sizeof($allMessages); $i++) {
							$message = str_replace("\n", "<br>", htmlspecialchars($allMessages[$i]['message']));
							$id = $allMessages[$i]['id']
							?>
						<tr>
							<td><?=$message?></td>
							<td class = "del">
								<a href = "<?=$startFolder."?delm=".$id?>">X</a>
							</td>
						</tr>
						<?}?>
						
					</table>
				</div> <!--just div-->
					<form id = "new_message" action="<?=$rootFolder?>req.php" method="post">
						<input type="hidden" name = "url" value = "<?=$folder?>">
						<textarea id="new_Mes" name = "new_message" class="form-control" rows="4"></textarea>
						<div class = "text-right" style="padding:10px">
							<button type="submit" class="btn btn-info">Send</button>		
						</div>
					</form>
				
			</div>
		</div>
	</div>
</div>

	
	
        <!-- JavaScript plugins (requires jQuery) -->
    <script src="<?=$rootFolder?>js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?=$rootFolder?>js/bootstrap.min.js"></script>

    
    <script>
		$("#new_Mes").keydown(ctrlEnt);
		function ctrlEnt(e) {
			if (e.ctrlKey && e.keyCode == 13) {
				$("#new_message").submit();
			}
		}
    </script>
  </body>
</html>
