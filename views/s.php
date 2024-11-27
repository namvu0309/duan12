 <div class="product-details-reviews section-padding pb-0">
     <div class="row">
         <div class="col-lg-12">
             <div class="product-review-info">
                 <ul class="nav review-tab">

                     <li>
                         <a class="active" data-bs-toggle="tab" href="#tab_three">Bình luận (<?= $countComment ?>)</a>
                     </li>
                 </ul>
                 <div class="tab-content reviews-tab">

                     <div class="tab-pane fade show active" id="tab_three">

                         <?php foreach ($listBinhLuan as $binhLuan): ?>
                             <div class="total-reviews">
                                 <div class="rev-avatar">
                                     <img src="<?= $binhLuan['anh_dai_dien'] ?>" alt="">
                                 </div>
                                 <div class="review-box">

                                     <div class="post-author">
                                         <p><span> <?= $binhLuan['ho_ten'] ?></span> <?= $binhLuan['ngay_dang'] ?></p>
                                     </div>
                                     <p><?= $binhLuan['noi_dung'] ?></p>
                                 </div>
                             <?php endforeach ?>
                             <form action="#" class="review-form">
                             </div>


                             <div class="form-group row">
                                 <div class="col">
                                     <label class="col-form-label"><span class="text-danger">*</span>
                                         Nội Dung Bình Luận</label>
                                     <textarea class="form-control" required></textarea>

                                 </div>
                             </div>
                             <div class="form-group row">

                             </div>
                             <div class="buttons">
                                 <button class="btn btn-sqr" type="submit"> Bình Luận</button>
                             </div>
                             </form> <!-- end of review-form -->
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>