<div>

    <?php
        if($documentType == "1") {
            require "templates/anexos/anexo1.php";
        }

        if($documentType == "2") {
            require "templates/anexos/anexo2.php";
        }

        if($documentType == "3") {
            require "templates/anexos/anexo3.php";
        }
    ?>
</div>

<style>
    p {
        font-size: 13px;
    }

    body {
        font-family: Elegance, sans-serif, Arial !important;
        background: #fff !important;
        color: #0b0b0b !important;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }
    td {
        border: 1px solid black;
        font-size: 13px;
        padding: 5px;
        vertical-align: top;
    }
    tr{
        border: 1px solid black;
    }
    img {
        width: auto; /* Adjust size as needed */
        height: 40px;
    }
    .text-content {
        font-size: 13px;
        font-weight: bold;
    }
    .logo-img{
        margin-top: 7px;
        margin-bottom: 7px;
    }
    .text-center {
        text-align: center;
    }
    .margin-top {
        margin-top: 20px;
    }
    .title{
        font-size: 18px;
    }
    .subtitle{
        font-size: 14px;
    }
    .space-to-fill{
        padding-bottom: 30px;
    }
</style>