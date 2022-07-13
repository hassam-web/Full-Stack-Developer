
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="frontend-assets/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="frontend-assets/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".like").click(function(event){
                event.preventDefault();
                const currentElement = event.target;
                const postId = currentElement.dataset.postId;
                const userId = currentElement.dataset.userId;
                $.ajax({
                    url: `http://blog-website.test/post.php?post_id=${postId}`,
                    type: 'POST',
                    data: {
                        liked:1,
                        post_id:postId,
                        user_id:userId,
                    },
                })
                .done(function() {
                    // console.log("success");
                    window.location.reload();
                })
                .fail(function() {
                    console.log("error");
                })
                
            })
            $(".unlike").click(function(event){
                event.preventDefault();
                const currentElement = event.target;
                const postId = currentElement.dataset.postId;
                const userId = currentElement.dataset.userId;
                $.ajax({
                    url: `http://blog-website.test/post.php?post_id=${postId}`,
                    type: 'POST',
                    data: {
                        unliked:1,
                        post_id:postId,
                        user_id:userId,
                    },
                })
                .done(function() {
                    // console.log("success");
                    window.location.reload();
                })
                .fail(function() {
                    console.log("error");
                })
                
            })
        });
    </script>
</body>

</html>