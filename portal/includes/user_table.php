                   

                                    
                                       <?php  
                                        $HWStmt= "SELECT * FROM height_weight WHERE pid='".$pid."' ";
                                            $HWResult = mysqli_query($conn, $HWStmt);
                                            $FetchHW = mysqli_fetch_assoc($HWResult);
                                            $CountHW = mysqli_num_rows($HWResult);
                                   $Gender =  $FetchPatient['sex'];
                                       $date = strtotime($FetchPatient['date_receive']);


                                       echo '<table style="border: 2px solid black" class="table">
                                           
                                                <tr>
                                                    <td widtd="40%"><b>Name:</b> &nbsp;'.$FetchPatient['patient_name'].'</td>
                                                    <td widtd="10%" ><b>Age:</b> &nbsp;'.$FetchPatient['age'].'</td>
                                                    <td widtd="10%"><b>Sex:</b> &nbsp;'.$FetchPatient['sex'].'</td>
                                                    <td widtd="40%"><b>Consultant:</b> &nbsp;'.$FetchPatient['consultant'].'</td>
                                                </tr>
                                                
                                                <tr>
                                                   <td colspan="2"><b>Clinical Diagnotics:</b> &nbsp;'.$FetchPatient['clinical_diagnosis'].'</td>
                                                   <td widtd="15%"><b>Date Printed</b> &nbsp;'.date("jS F, Y").'</td>
                                                    <td widtd="40%"><b>Hospital Clinic:</b> &nbsp;'.$FetchPatient['hospital'].'</td>   
                                                </tr>

                                                 <tr>
                                                    <td widtd="20%"><b>Nature of Specimen:</b> &nbsp;'.$FetchPatient['nature'].'</td>
                                                    <td widtd="15%" ><b>Lab No:</b> &nbsp;'.$FetchPatient['labno'].'</td>
                                                    <td widtd="15%"><b>Date Received</b> &nbsp;'.date("jS F, Y", $date).'</td>
                                                    <td widtd="30%"><b>Clinic Address</b> &nbsp;'.$FetchPatient['clinic_address'].'</td>
                                                </tr>';
                                                if ($CountHW == 1) {
                                                  echo'<tr>
                                                    <td widtd="25%"><b>Height: &nbsp;</b> &nbsp;'.$FetchHW['height'].'</td>
                                                    <td widtd="25%" ><b>Weight: &nbsp;</b> &nbsp;'.$FetchHW['weight'].'</td>
                                                    <td widtd="25%"><b>Waist: &nbsp;</b> &nbsp;'.$FetchHW['waist'].'</td>
                                                    <td widtd="25%"><b>Hip :&nbsp;</b> &nbsp;'.$FetchHW['hip'].'</td>
                                                </tr>';
                                            }
                                               


                                                echo '<tr><td colspan="4"><b>Investigation Required:</b> &nbsp;'.$FetchPatient['investigation'].' </td></tr>
                                        </table>';
                                        ?>
                                  