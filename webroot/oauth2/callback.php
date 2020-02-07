<?php
if (isset($_GET['code'])) {
    print 'your code: ' . $_GET['code'];
} else {
    print 'code get error. try again!';
}