				print("<td><form name='btnForm' method='post' action='article_delete_execute.php' onsubmit='return submitChk()'>");
				print("<input class='w3-btn w3-grey'  type='submit' name='submit' value='delete'>");
				print("</form></td>");
				
				
				print("<td><form name='btnForm' method='post' action='article_delete_execute.php?id=");
                print($id);
                print("&cursor=");
                print($id);
				print("' onsubmit='return submitChk()'>");
				print("<input class='w3-btn w3-grey'  type='submit' name='submit' value='delete'>");
				print("</form></td>");


				<script>
					function submitChk () {
						var flag = confirm ( "Execute?");
						return flag;
					}
				</script>
