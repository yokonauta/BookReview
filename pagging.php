<?php
            //=== Pagging ===
            $prev=$cursor-$range;
            $next=$cursor+$range; 

            // Prev button
            if($prev<0){
                if($cursor>0){
                    print("<a href='" . $this_page . "?idx=0'");
                    if(isset($filter)) print("&filter=" . $filter);
                    print(" class='w3-btn w3-indigo'>prev</a>&nbsp");
                }
                else { 
                    print("<a href='" . $this_page . "?idx=0'");
                    if(isset($filter)) print("&filter=" . $filter);
                    print(" class='w3-btn w3-indigo w3-disabled'>prev</a>&nbsp");
                }
            }
            else{
                print("<a href='" . $this_page . "?idx=$prev'");
                if(isset($filter)) print("&filter=" . $filter);
                print(" class='w3-btn w3-indigo'>prev</a>&nbsp");
            }

            // Numeric button
            $pages = $total / $range + 1;
            for ($i=1; $i<$pages; $i++)
            {
                $idx=($i * $range) - $range; 
                print("<a href='" . $this_page . "?idx=$idx");
                if(isset($filter)) print("&filter=$filter");
                print("'class='w3-btn w3-indigo'>$i</a>&nbsp");
            }
            // Next button
            if($next>=$total){
                print("<a href='" . $this_page . "?idx=$cursor");
                if(isset($filter)) print("&filter=$filter");
                print("' class='w3-btn w3-indigo w3-disabled'>next</a>");
            }
            else{
                print("<a href='" . $this_page . "?idx=$next");
                if(isset($filter)) print("&filter=$filter");
                print("' class='w3-btn w3-indigo'>next</a>");
            }
?>