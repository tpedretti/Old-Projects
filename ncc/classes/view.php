<?php
require_once 'session.php';
require_once 'database.php';

class view {
    public $locView;
             
   function publicView() {
        $content = '';
        $content .= '<div class="page-header" id="banner">'
                . '<div class="row">'
                . '    <div class="col-lg-8 col-md-7 col-sm-6">'
                . '        <h1>NCC Report Problem</h1>'
                . '       <p class="lead">To report a problem with a restroom or anything else!</p>'
                . '    </div>'
                . '</div>'
                . '</div>';      
        $content .= '<div class="row" >'
                . '<div class="well bs-component" >'
                . '<form class="form-horizontal" role="form" method="post" action="process.php">'
                . '   <fieldset>'
                . '     <legend>Please Fillout to file Complaint</legend>'
                . '         <div class="form-group">'
                . '             <label for="select" class="col-lg-2 control-label">Location</label>'
                . '                 <div class="col-lg-10">'
                . '                     <select class="form-control" id="select" name="locSelect">'
                . '                         <option>ATEC - 1st Floor - Men Restroom</option>'
                . '                         <option>ATEC - 1st Floor - Women Restroom</option>'
                . '                         <option>CSS  - 1st Floor - Men Restroom</option>'
                . '                         <option>CSS  - 1nd Floor - Women Restroom</option>'
                . '                         <option>CSS  - 2nd Floor - Men Restroom</option>'
                . '                         <option>CSS  - 2nd Floor - Women Restroom</option>'
                . '                         <option>HUM  - 1st Floor - Men Restroom</option>'
                . '                         <option>HUM  - 2st Floor - Men Restroom</option>'
                . '                         <option>HUM  - 2nd Floor - Women Restroom</option>'
                . '                         <option>LIBR - 1st Floor - Men Restroom</option>'
                . '                         <option>LIBR - 1st Floor - Women Restroom</option>'
                . '                         <option>LIBR - 2nd Floor - Men Restroom</option>'
                . '                         <option>LIBR - 2nd Floor - Women Restroom</option>'
                . '                         <option>ST   - 1st Floor - Women Restroom</option>'
                . '                         <option>WEQ  - Men Restroom</option>'
                . '                         <option>WEQ  - Women Restroom</option>'
                . '                         <option>IT   - 1st Floor - Men Restroom</option>'
                . '                         <option>IT   - 1st Floor - Women Restroom</option>'
                . '                         <option>IT   - 2nd Floor - Men Restroom</option>'
                . '                         <option>IT   - 2nd Floor - Women Restroom</option>'
                . '                         <option>Parking Lot "A" Ticket Dispenser</option>'
                . '                         <option>Parking Lot "B" Ticket Dispenser</option>'
                . '                         <option>Parking Lot "C" Ticket Dispenser</option>'
                . '                     </select>'
                . '                     <br>'
                . '                 </div>'
                . '                 </div>'
                . '         <div class="form-group">'
                . '             <label for="select" class="col-lg-2 control-label">Priority</label>'
                . '                 <div class="col-lg-10">'
                . '                     <select class="form-control" id="selectPriority" name="problemPriority">'
                . '                         <option>LOW</option>'
                . '                         <option>MEDIUM</option>'
                . '                         <option>HIGH</option>'
                . '                     </select>'
                . '                     <br>'
                . '                 </div>'
                . '                 </div>'
                . '         <div class="form-group">'
                . '             <label for="textArea" class="col-lg-2 control-label">Problem</label>'
                . '                 <div class="col-lg-10">'
                . '                     <textarea class="form-control" rows="3" maxlength="140" id="textArea" name="problemDic" onKeyDown="limitText(this.form.problemDic,this.form.countdown,140);" onKeyUp="limitText(this.form.problemDic,this.form.countdown,140);"></textarea>'
                . '                     <font size="1">(Maximum characters: 140)<br>'
                . '                     You have <input readonly type="text" name="countdown" size="3" value="140"> characters left.</font>'
                . '                 </div>'
                . '         </div>'
                . '     <div class="form-group">'
                . '         <div class="col-lg-10 col-lg-offset-2">'
                . '             <button type="submit" class="btn btn-primary">Submit</button>'
                . '         </div>'
                . '     </div>'
                . '</fieldset>'
                . '</form>'
                . '</div>'
                . '</div>';        
        return $content;
    }
    function adminView() {
        $temp = new database();
        $content = '';
        if(session::isLoggedIn() === TRUE) {
            $content .= '<div class="page-header" id="banner">'
                . '<div class="row">'
                . '    <div class="col-lg-8 col-md-7 col-sm-6">'
                . '        <h1>ADMIN PANEL</h1>'
                . '       <p class="lead">Everything and anything you need!</p>'
                . '    </div>'
                . '</div>'
                . '</div>';   
            $result = $temp->getPost();            
            $content .= '<table class="table table-striped table-hover ">';
            $content .= '<thead>'
                     . ' <tr>'
                     . '<th>#</th>'
                     . '<th>Time</th>'
                     . '<th>Location</th>'
                     . '<th>Reason</th>'
                     . '<th>Detele'
                     . '</tr>'
                     .'</thead>';
            //$content .= '<form method="post" action="process.php">';
            while($row = mysqli_fetch_array($result)) {
                if($row['priority'] == "low") {
                    $content .= '<tr>';
                }elseif ($row['priority'] == "mid") {
                    $content .= '<tr class="warning">';
                }else {
                    $content .= '<tr class="danger">';
                }
                $content .= '<td>' . $row['uniqueID'] . '</td>';
                $tempTime = date("F j, Y, g:i a", strtotime($row['time']));                
                //$content .= '<td>' . $row['time'] . '</td>';
                $content .= '<td>' . $tempTime . '</td>';
                $content .= '<td>' . $row['location'] . '</td>';
                $content .= '<td>' . $row['reason'] . '</td>';
                $content .= '<td><form method="post" action="process.php"><input type="hidden" id="quoteid" name="deleteID" value="'.$row[uniqueID].'" /><button type="submit" class="btn btn-primary btn-xs">Delete</button></form></td>';
                $content .= '</tr>';
            }
            //$content .= '</form>';
            $content .= '</table>';
            
            return $content;
        }
        else {
            echo '</br></br></br></br>Ummm you shouldn\'t be here!</br></br>';
            echo session::isLoggedIn();
            print_r($_SESSION);
        }
    }
}
