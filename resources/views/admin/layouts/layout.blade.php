<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('admin_dashboard/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <link href="{{ asset('admin_dashboard/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet')}}" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('admin_dashboard/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('admin_dashboard/css/style.css')}}" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        @include('admin.layouts.partials.sidebar')
        <!-- Sidebar End -->
   <!-- Flash Messages -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('admin.layouts.partials.navbar')
            <!-- Navbar End -->
            @if (session('success'))
                <div class="alert alert-success fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-danger fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif

          



            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
            @yield('content')

            </div>
            <!-- Widgets End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4 " style="margin-top:220px">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Ecommerce</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin_dashboard/lib/chart/chart.min.js')}}"></script>
    <script src="{{ asset('admin_dashboard/lib/easing/easing.min.js')}}"></script>
    <script src="{{ asset('admin_dashboard/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ asset('admin_dashboard/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('admin_dashboard/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{ asset('admin_dashboard/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{ asset('admin_dashboard/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('admin_dashboard/js/main.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
      
        setTimeout(function() {
            $('.alert').alert('close');
        }, 3000);

        var productIdToDelete; // Variable to store product ID to delete
        
        $('.delete-btn').click(function() {
   
            productIdToDelete = $(this).data('product-id');
        console.log( productIdToDelete);
            var productName = $(this).closest('tr').find('td:eq(0)').text(); // Example: Assuming the product name is in the first column

            // Update modal with product name and show
            $('#productName').text(productName);
            $('#confirmDeleteModal').modal('show');
        });

        $('.delete-confirm').click(function() {
            // Perform AJAX request to delete product
            $.ajax({
                url: '/product/' + productIdToDelete,
                type: 'POST',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    '_method': 'DELETE'
                },
                success: function(response) {
                    $('#exampleModal2').modal('hide');
$('#productRow' + productIdToDelete).remove();
showAlert('success', response.message);

setTimeout(function() {
    location.reload(); // This will refresh the page after 7 seconds
}, 1000); // 7000 milliseconds = 7 seconds
           
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(error);
                    alert('Failed to delete product. Please try again.');
                    showAlert('danger', 'An error occurred while deleting the product.');
                }
            });
        });
    });

    function closeModal() {
        $('#exampleModal2').modal('hide');
    }

    function showAlert(type, message) {
        var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">'
                        + message
                        + '</div>';
        var alertElement = $(alertHtml);
        $('#alert-container').html(alertElement);

        // Set timeout to remove the alert after 5 seconds (5000 ms)
        setTimeout(function() {
            alertElement.alert('close');
        }, 500);
    }

</script>

</body>

</html>