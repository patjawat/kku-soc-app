<?php
                        $n = $model->progressPerson();
                        if($n == 1){
                            $bgColor = 'bg-danger';
                        }else if($n == 24){
                            $bgColor = 'bg-warning';
                        }else if($n == 36){
                            $bgColor = 'bg-info';
                        }else if($n == 48){
                            $bgColor = 'bg-info';
                        }else if($n == 60){
                            $bgColor = 'bg-info';
                        }else if($n == 72){
                            $bgColor = 'bg-info';
                    
                        }else if($n == 48){
                            $bgColor = 'bg-primary';
                    
                    }else{
                        $bgColor = 'bg-success';

                    }
                        ?>
                            <div class="progress progress-sm">
                                <div class="progress-bar <?=$bgColor;?>" role="progressbar" aria-valuenow="57"
                                    aria-valuemin="0" aria-valuemax="100" style="width: <?=$model->progressPerson();?>%">
                                </div>
                            </div>
                            <small>
                                <?=$model->progressPerson();?>%  &nbsp;(<?=$model->step->name;?>)
                            </small>