<html>
    <head>
        <title>kultafarmi</title>
    </head>
    <body>
        <center>
            <h1>kultafarmi</h1>
            <form class="center" action="post.php" method="post">
            <table>
				<tbody>
                    <tr>
					    <td>
                            <label for="name">nickname</label>
                        </td>
					    <td>
                            <input id="name" type="text" name="name">
                        </td>
				    </tr>
				    <tr>
					    <td>
                            <label for="message">message</label>
                        </td>
				    	<td>
                            <textarea id="message" rows="10" cols="50" name="msg"></textarea>
                        </td>
			    	</tr>
			    </tbody>
                </table>
                <input type="submit" value="post">
                <input type="reset" value="reset">
                <input type="button" value = "refresh" onclick="location.reload()" />
            </form>
        </center>
        <?php
            $myfile = fopen("messages.txt", "r") or die("Unable to open file!");
            echo str_replace("\n", "<br>", fread($myfile,filesize("messages.txt")));
            fclose($myfile);
        ?>
    </body>
</html>
