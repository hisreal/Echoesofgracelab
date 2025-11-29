 <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <script>document.write(new Date().getFullYear())</script> © Echoes Of Grace Medical Lab. - Developed by <b>Hisrealite</b>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    
                   
                </div>
            </div>
        </div>
        
    </div>

    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- Datatables js -->
    <script src="../assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="../assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js"></script>
    <script src="../assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="../assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
    <!-- jQuery + DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <!-- Table Editable plugin-->
   <script src="../assets/vendor/jquery-tabledit/jquery.tabledit.min.js"></script>
   <!-- Table editable init-->
   <script src="../assets/js/pages/tabledit.init.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tabledit/1.2.3/jquery.tabledit.min.js"></script>
<script>
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function () {
        const inputId = this.getAttribute('data-target');
        const input   = document.getElementById(inputId);

        if (input.type === "password") {
            input.type = "text";
            this.textContent = "Hide";
        } else {
            input.type = "password";
            this.textContent = "Show";
        }
    });
});
</script>

<script>
$(document).ready(function(){

    $('#btn-editable').Tabledit({
        columns: {
            identifier: [0, 'id'],
            editable: [
                [1, 'name'],
                [2, 'position'],
                [3, 'office'],
                [4, 'age'],
                [5, 'start_date'],
                [6, 'salary']
            ]
        },
        buttons: {
            edit: {
                class: 'btn btn-sm btn-primary',
                html: '<i class="mdi mdi-pencil"></i>',
                action: 'edit'
            },
            delete: {
                class: 'btn btn-sm btn-danger',
                html: '<i class="mdi mdi-delete"></i>',
                action: 'delete'
            },
            save: {
                class: 'btn btn-sm btn-success',
                html: 'Save'
            },
            restore: {
                class: 'btn btn-sm btn-warning',
                html: 'Restore',
                action: 'restore'
            },
            confirm: {
                class: 'btn btn-sm btn-secondary',
                html: 'Confirm'
            }
        },
        url: 'ajax/update-table.php',
    });

});
</script>

</body>


</html>