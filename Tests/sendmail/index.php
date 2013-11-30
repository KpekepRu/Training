<html>
<head><title>�������� ���������� �������� ��� sendmail</title></head>
<body>

<?
@extract($_SERVER, EXTR_SKIP); @extract($_POST, EXTR_SKIP); @extract($_GET, EXTR_SKIP);
if(!@$to) $to="me@somehost.ru";
if(!@$subject) $subject="Congratulations!";
if(!@$body) $body="Hello!\nToday is ".date("Y-m-d").".\nThis is the test\nmail body.\n\nIf you see this, sendmail stub seems to be OK.";
?>

<form action="<?=$_SERVER["REQUEST_URI"]?>" method=POST>
<?if (empty($_GET['noform'])) {?>
	<h2>������� �������� ������:</h2>
	<table  cellpadding=5 cellspacing=2>
	<tr valign=top>
		<td>To:</td>
		<td><input type=text name=to value="<?=@HtmlSpecialChars($to)?>"></td>
	</tr>
	<tr valign=top>
		<td>Subject:</td>
		<td><input type=text name=subject value="<?=@HtmlSpecialChars($subject)?>"></td>
	</tr>
	<tr valign=top>
		<td>�����:</td>
		<td><textarea name=body cols=50 rows=4><?=@HtmlSpecialChars($body)?></textarea></td>
	</tr>
	<tr valign=top>
		<td colspan=2>
			<input type=submit name=doSendSendmail value="������� ����� mail() (sendmail)">
			<input type=submit name=doSendSmtp value="������� ����� fsockopen() (SMTP)">
			<input type=submit name=doDel value="�������� ���������� ����������">
		</td>
	</tr>
	</table>
<?} else {?>
	<input type=submit name=doDel value="�������� ���������� ����������">
<?}?>
</form>

<?
$dir = "/tmp/!sendmail";

if (@$doDel) {
	if ($d = @opendir($dir)) {
		while (false !== ($e = readdir($d))) {
			if ($e[0] == ".") continue;
			unlink("$dir/$e");
		}
	}
	//echo "<h3>������ �������.</h3>";
}

if (@$doSendSendmail) {
	echo "<h2>�������� ������ ����� mail()...</h2>\n";
	if (mail($to,$subject,$body,"From: \"PHP mail()\" <mail@php.net>")) {
		echo "OK, ������� mail() ��������� ���������.<br>\n";
	} else {
		echo "��� ������ mail() ��������� ������.<br>\n";
	}
}

if (@$doSendSmtp) {
	function waitAnswer($f) {
		fread($f, 128);
	}
	echo "<h2>�������� ������...</h2>\n";
	$f = fsockopen('localhost', 25, $errno, $errstr, 3);
	if ($f) {
		fwrite($f, "HELO localhost\r\n");
		waitAnswer($f);
		fwrite($f, "RCPT TO: test@example.com\r\n");
		waitAnswer($f);
		fwrite($f, "DATA\r\n");
		waitAnswer($f);
		fwrite($f, "From: test <test@example.com>\r\n");
		fwrite($f, "To: test <test@example.com>\r\n");
		fwrite($f, "Subject: Testing mail\r\n");
		fwrite($f, "\r\n");
		fwrite($f, "This is a test mail sent via fsockopen().\r\n");
		fwrite($f, "Today is " . date("r") . ".\r\n");
		fwrite($f, ".\r\n");
		waitAnswer($f);
		fwrite($f, "QUIT\r\n");
		waitAnswer($f);
	}
	if ($f && fclose($f)) {
		echo "OK, ������ ���������� �������.<br>\n";
		sleep(1); // wait for mail is arrived
	} else {
		echo "��� ���������� � �������� ��������� ������.<br>\n";
	}
}


$d = @opendir($dir);
if ($d) {
	echo "<h2>���������� ������ � ���������� <tt>$dir</tt></h2>\n";
	echo "<p>������ ������ �������� � ��������� ����� � ����������� .eml. ��� ����� ������, �.�. ��������� ������� ����� ���� � Outlook � �����������, ��� ������ �������� � ������ ���� ������������� � ��������������.</p>";
	$list = array();
	while (false !== ($e = readdir($d))) {
		if ($e[0] == ".") continue;
		$list[] = "$dir/$e";
	}
	rsort($list);

	if ($list) {
		foreach ($list as $fname) {
			$f = @fopen($fname, "r"); if (!$f) continue;
			echo "<h3>���� <tt>$fname</tt>:</h3>\n";
			echo "<pre>\n";
			echo HtmlSpecialChars(fread($f,filesize($fname)));
			echo "</pre>\n";
			echo "<hr>";
		}
	} else {
		echo "���������� �����.";
	}
}
?>

</body>
</html>
