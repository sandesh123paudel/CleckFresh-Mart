<?php
include("../db/connection.php");

if (isset($_GET['action'])) {
    $product_id = $_GET['pid'];
    $user_id = $_GET['uid'];
    $review_id = '';

    if ($_GET['action'] == 'rating') {
        if (isset($_GET['rate'])) {
            $rate = $_GET['rate'];

            $extsql = "SELECT * FROM REVIEW WHERE USER_ID = :user_id AND PRODUCT_ID = :product_id";
            $extstmt = oci_parse($connection, $extsql);
            oci_bind_by_name($extstmt, ":user_id", $user_id);
            oci_bind_by_name($extstmt, ":product_id", $product_id);
            oci_execute($extstmt);

            while ($data = oci_fetch_array($extstmt)) {
                if (isset($data['REVIEW_ID'])) {
                    $review_id = $data['REVIEW_ID'];
                }
            }
            if (!empty($review_id)) {
                $sql = "UPDATE REVIEW SET RATING = :rating WHERE REVIEW_ID = :review_id";
                $stid = oci_parse($connection, $sql);
                oci_bind_by_name($stid, ":review_id", $review_id);
                oci_bind_by_name($stid, ":rating", $rate);
                if (oci_execute($stid)) {
                    echo "Your Rating is successfully recorded!!";
                }
            } else {
                $sql = "INSERT INTO REVIEW (USER_ID, PRODUCT_ID, RATING) VALUES (:user_id, :product_id, :rating)";
                $stid = oci_parse($connection, $sql);
                oci_bind_by_name($stid, ":user_id", $user_id);
                oci_bind_by_name($stid, ":product_id", $product_id);
                oci_bind_by_name($stid, ":rating", $rate);

                if (oci_execute($stid)) {
                    echo "Your Rating is successfully recorded!!";
                }
            }
        }
    } else if ($_GET['action'] == 'review') {
        if (isset($_GET['review'])) {
            $review = $_GET['review'];

            $extsql = "SELECT * FROM REVIEW WHERE USER_ID = :user_id AND PRODUCT_ID = :product_id";
            $extstmt = oci_parse($connection, $extsql);
            oci_bind_by_name($extstmt, ":user_id", $user_id);
            oci_bind_by_name($extstmt, ":product_id", $product_id);
            oci_execute($extstmt);
            while ($data = oci_fetch_array($extstmt)) {
                if (isset($data['REVIEW_ID'])) {
                    $review_id = $data['REVIEW_ID'];
                }
            }

            if (!empty($review_id)) {
                $sql = "UPDATE REVIEW SET REVIEW_DESCRIPTION = :review WHERE REVIEW_ID = :review_id";
                $stid = oci_parse($connection, $sql);
                oci_bind_by_name($stid, ":review_id", $review_id);
                oci_bind_by_name($stid, ":review", $review);

                if (oci_execute($stid)) {
                    echo "Your Review is successfully recorded!!";
                }
            } else {

                $sql = "INSERT INTO REVIEW (USER_ID, PRODUCT_ID, REVIEW_DESCRIPTION) VALUES (:user_id, :product_id, :review)";
                $stid = oci_parse($connection, $sql);
                oci_bind_by_name($stid, ":user_id", $user_id);
                oci_bind_by_name($stid, ":product_id", $product_id);
                oci_bind_by_name($stid, ":review", $review);

                if (oci_execute($stid)) {
                    echo "Your Review is successfully recorded!!";
                }
            }
        }
    }
}
