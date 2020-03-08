        <div class="w3-card-2 w3-margin">
            <div class="w3-container w3-padding">
               <h5>Tags</h5>
            </div>
            <div class="w3-container w3-white">
            <p>
            <?php
            try {
                $db = new PDO('sqlite:sqlite3/bookreview.sqlite3');
                $sql = "SELECT * FROM genre";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();

                $last = count($result);
                //print("genre : " . $genre . "<br>");
                //print("genre count : $last" . "<br>");
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
            $db = null;

            $id_array = array();
            $item_array = array();
            foreach($result as $item){
                $id_array[] = $item[0];
                $item_array[]=$item[1];
            }
            for ($i=0; $i<$last; $i++){
                print("<span class='w3-tag ");
                if($genre==$i+1)print('w3-black');
                else print('w3-light-grey');
                print(" w3-margin-bottom'>");
                print("<a href='show_articles_by_genre.php?genre=" . ($i+1) ."'>");
                print($item_array[$i]);
                print("</a></span>"); 
            }

            ?>
<!--
            <span class="w3-tag <?php if($genre==1)print('w3-black');else print('w3-light-grey'); ?> w3-margin-bottom"><a href="show_articles_by_genre.php?genre=1">Art</a></span> 
            <span class="w3-tag <?php if($genre==2)print('w3-black');else print('w3-light-grey'); ?> w3-small w3-margin-bottom"><a href="show_articles_by_genre.php?genre=2">Mystery</a></span> 
            <span class="w3-tag <?php if($genre==3)print('w3-black');else print('w3-light-grey'); ?> w3-small w3-margin-bottom"><a href="show_articles_by_genre.php?genre=3">Thriller</a></span> 
            <span class="w3-tag <?php if($genre==4)print('w3-black');else print('w3-light-grey'); ?> w3-small w3-margin-bottom"><a href="show_articles_by_genre.php?genre=4">Fiction</a></span> 
            <span class="w3-tag <?php if($genre==5)print('w3-black');else print('w3-light-grey'); ?> w3-small w3-margin-bottom"><a href="show_articles_by_genre.php?genre=5">Non Fiction</a></span>  
            <span class="w3-tag <?php if($genre==5)print('w3-black');else print('w3-light-grey'); ?> w3-small w3-margin-bottom"><a href="show_articles_by_genre.php?genre=5">HistoryNon Fiction</a></span>  
-->
           </p>
            </div>
        </div>
