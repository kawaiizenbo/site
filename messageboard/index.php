<?php include 'templateTop.php'?>
<title>messageboard</title>
<h1>messageboard</h1>
<center>
<form class="center" action="post.php" method="post">
    <table>
	    <tbody>
            <tr>
				<td>
                    <label for="name">nickname</label>
                </td>
				<td>
                    <input id="nickname" type="text" name="nickname">
                </td>
			</tr>
			<tr>
				<td>
                    <label for="body">body *</label>
                </td>
				<td>
                    <textarea id="body" rows="8" cols="40" name="body"></textarea>
                </td>
			</tr>
            <tr>
				<td>
                    <label for="image_url">image URL</label>
                </td>
				<td>
                    <input id="image_url" type="text" name="image_url">
                </td>
			</tr>
		</tbody>
    </table>
    <span>* required</span>
    <input type="submit" value="post">
    <input type="reset" value="reset">
    <input type="button" value="refresh" onclick="location.reload()" />
</form>
</center>
<hr>
<?php include 'getHTML.php'?>
<?php include 'templateBottom.php'?>
