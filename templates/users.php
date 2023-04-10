<?php

if (!empty($errors)) {
    json_encode($errors);
} else {
    echo json_encode($result);
};

// if (!empty($errors)) {
//     json_encode($errors);
// }
