<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>BluInvoice</title>
    <style>
        .heoo{
            font-size: 85px !important;
            color: #2a4291;
        }
        .dferfe{
            display: grid;
        }
        th{
            color: #2a4291;
            background-color: #c4dff6;            
        }
        .table, td, th{
            border: 2px solid #88a3d79e;
        }
        .table-bordered {
            border: 3px solid #88a3d7;
        }
        span{
            line-height: 35px;
            font-size: 25px;
        }
    </style>
</head>
<body>
    <section>
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <span><b>Date:</b> 02 June, 2023</span>
            </div>
            <div class="col-md-1"></div>

            <div class="col-md-1">
                <span>YOUR LOGO</span>
            </div>
            <div class="col-md-8 text-center">
                <span><b class="heoo">Invoice</b></span><br><br>
                <span>No. 000001</span><br><br>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>



            <div class="col-md-1"></div>
            
            <div class="col-md-5 dferfe">
                <span><b>Billed to: </b></span>
                <span>Thynk Unlimited</span>
                <span>23 Anywhere St., Any City, ST 12345</span>                
                <span>www.reallygreatsite.com</span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="col-md-5 dferfe">
                <span><b>From: </b></span>
                <span>MAAVALAN CONSULTANCY PRIVATE</span>
                <span>LIMITED</span>
                <span>B-302, Jaipur, JAIPUR, 302004,</span>
                <span>JANTA COLONY</span>
                <span>Rajasthan</span>
                <span>GSTIN: 08AAMCM9357K1ZN</span>
                <span>Email: shubham.jsco@gmail.com</span>
                <span>Mobile: +91 9549815565</span><br><br>
            </div>
            <div class="col-md-1"></div>
        
            <div class="col-md-12">
                <table class="table text-center ">
                    <tr>
                        <th>Description</th>
                        <th>SAC CODE</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Disc.</th>
                        <th>Taxable value</th>
                        <th>Non Taxable value</th>
                        <th>CGST</th>
                        <th>SGST</th>
                        <th>IGST</th>
                        <th>Final Amount</th>
                    </tr>
                    <tr>
                        <td>ITR1</td>
                        <td>998231</td>
                        <td>1</td>
                        <td>500</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>$500</td>
                    </tr>
                    <tr>
                        <td>ITR2</td>
                        <td>998231</td>
                        <td>2</td>
                        <td>700</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>$90</td>
                    </tr>
                    <tr>
                        <td>ITR3</td>
                        <td>998231</td>
                        <td>3</td>
                        <td>1000</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>$165</td>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Total amount</th>
                        <th>$755</th>
                    </tr>
                </table>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3 dferfe">
                <span><b>Payment method:</b>Cash</span>
                <span><b>Note:</b>Thank you for choosing us!</span>
            </div>
            <div class="col-md-8"></div>
            <div class="col-md-12">
                <img src="{{url('public/images/pdfimg.png')}}" style="width: 99%;height: 100%;">
            </div>

        </div>
    </section>
</body>
</html>