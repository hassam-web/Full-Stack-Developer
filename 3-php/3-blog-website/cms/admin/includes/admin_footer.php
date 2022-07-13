
    <!-- jQuery -->
    <script src="admin-assets/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="admin-assets/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#selectAllBoxes").click(function(){
                const selectAllCheckbox = this.checked;
                if(selectAllCheckbox){
                    $(".rowCheckbox").each(function(index, element) {
                        this.checked = true;
                    });
                }else{
                    $(".rowCheckbox").each(function(index, element) {
                        this.checked = false;
                    });
                }
                
            })
        });
    </script>
</body>

</html>