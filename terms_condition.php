<?php include('header.php');
$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='terms_condition'");
$result12 = mysqli_fetch_array($sql12);
 ?>

        <section class="faqs">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="Heading-title black">
                                <h1><?php echo $result12['title1']; ?></h1>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <p>
							<?php
							$terms=mysqli_query($con,"SELECT * FROM `terms_condition` WHERE id='1'");
							$rowterms=mysqli_fetch_array($terms);
							echo $rowterms['content'];
							?>
							</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
 <?php include('footer.php'); ?>