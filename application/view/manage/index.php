<div id="main-alt">
    <div class="col-lg-12">
        <div class="page-title-container">
            <h2>Manage Listings</h2>
            <p>Edit, delete, or check messages for listings you posted.</p>
        </div>
        <div class="row" id="main-alt" style="background: #f8f8f8;height: auto!important;">
            <div class="container">
                <div class="page-subtitle-container">
                    <h2>Your Listings</h2>
                </div>
                <?php
                $count = 0;
                foreach ($result as $result) {
                    $rental_unit_id = $result->rental_unit_id;
                    ?>
                    <div class="col-lg-4 text-center">
                        <div class="manage-listing-container">
                            <div class="listing-image-container">
                                <div class="listing-price"><?php if (isset($result->rent)) echo '$' . htmlspecialchars($result->rent, ENT_QUOTES, 'UTF-8'); ?></div>
                                <form action="<?php echo URL; ?>favorites/addFavorite" method="POST">
                                    <button type="submit" value="<?php $result->rental_unit_id ?>" class="favorite-btn"><i class="ionicons ion-ios-heart"></i></button>
                                </form>
                                <?php
                                if (isset($result->thumbnail)) {
                                    echo "<img src='data:image/jpeg;base64," . base64_encode($result->thumbnail)
                                    . "' alt='Item image' class='thumbnail' height='230'>";
                                }
                                if (!isset($result->thumbnail)) {
                                    echo "<img src='" . URL . "img/default-thumbnail.jpg' title='default' width='330' height='230' class='thumbnail'>";
                                }
                                ?>
                            </div>
                            <div class="manage-listing-preview">
                                <h4><a href="<?php echo URL; ?>home/showSelectedListing?rental_unit_id=<?php echo $rental_unit_id ?>" target="_blank"><?php if (isset($result->title)) echo htmlspecialchars($result->title, ENT_QUOTES, 'UTF-8'); ?></a></h4>
                                <p><?php if (isset($result->type)) echo htmlspecialchars($result->type, ENT_QUOTES, 'UTF-8'); ?> -
                                    <?php
                                    if (isset($result->beds)) {
                                        if ($result->beds == 1) {
                                            echo htmlspecialchars($result->beds, ENT_QUOTES, 'UTF-8');
                                            echo " Bedroom";
                                        } else {
                                            echo htmlspecialchars($result->beds, ENT_QUOTES, 'UTF-8');
                                            echo " Bedrooms";
                                        }
                                    }
                                    ?></p>
                                <p><?php if (isset($result->zipcode)) echo htmlspecialchars($result->zipcode, ENT_QUOTES, 'UTF-8'); ?></p>
                                <p><?php
                                    if (isset($result->date_created)) {
                                        echo "Posted on ";
                                        echo htmlspecialchars(date("m-d-Y", strtotime($result->date_created)), ENT_QUOTES, 'UTF-8');
                                    }
                                    ?></p>
                                <a href="<?php echo URL; ?>manage/editRentalUnit/<?php echo $result->rental_unit_id; ?>">Edit</a> |
                                <a href="<?php echo URL; ?>manage/deleteRentalUnit/<?php echo $result->rental_unit_id; ?>">Delete</a> |
                                <a href="<?php echo URL; ?>manage/<?php
                                if ($result->is_rented == 0)
                                    echo 'markRented';
                                else
                                    echo 'markAvailable';
                                ?>/<?php echo $result->rental_unit_id; ?>" >Mark As 
                                       <?php
                                       if ($result->is_rented == 0)
                                           echo 'Rented';
                                       else
                                           echo 'Available';
                                       ?> 
                                </a>|
                                <a href="<?php echo URL; ?>manage/displayMessages?rental_unit_id=<?php echo $rental_unit_id ?>" target="_blank">Messages</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    $count++;
                }
                if ($count == 0) {
                    ?>
                    <h4 class='text-center'>You have no listings yet!</h4>
                    <div class='manage-post-listing-btn-container'>
                        <a href="<?php echo URL; ?>post" class='manage-post-listing-btn'>Post a Listing</a>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
</div>