<?php include('header.php'); 
$id=$_GET['id'];
$sql1 = mysqli_query($con,"SELECT * FROM `blog` WHERE id='$id'");
$result1 = mysqli_fetch_array($sql1);

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='blog_view'");
$result12 = mysqli_fetch_array($sql12);
?>

        <section class="categories-list-page light-grey">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">

                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <div class="blog-post">
                                <div class="post-img">
                                    <img src="images/<?php echo $result1['blog_img']; ?>" alt="" class="img-responsive">
                                </div>
                                <div class="blog-single">
                                    <div class="post-info">
                                        <a href="#"><?php echo $result1['blog_date']; ?></a>
                                    </div>
                                    <h3 class="post-title">
							 <?php echo $result1['blog_title']; ?>
								</h3>
                                    <p>
                                        <?php echo $result1['blog_content']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <aside>
                                <div class="widget">
                                    <div class="widget-heading"><span class="title"><?php echo $result12['title1']; ?></span></div>
										<ul class="recentpost">
										<?php
											$select_blog=mysqli_query($con,"SELECT * FROM `blog` LIMIT 10");
											while($row_blog=mysqli_fetch_array($select_blog))
											{
										?>
											<li> <span><a class="plus" href="blog_view?id=<?php echo $row_blog['id']; ?>"><img src="images/<?php echo $row_blog['blog_img']; ?>" alt="" /><i>+</i></a></span>
												<p><a href="blog_view?id=<?php echo $row_blog['id']; ?>"><?php echo $row_blog['blog_title']; ?></a></p>
												<h3><?php echo $row_blog['blog_date']; ?></h3>
											</li>
											<?php } ?>
									   </ul>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php include('footer.php'); ?>