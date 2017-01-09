<html>
<head>
<h1>DONE</h1>
</style>

<link rel="stylesheet" href="css/consolepages.css" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
<div class="row new-post">
        <div class="col-md-6 col-md-offset-3">
       
            <header><h3>Comments</h3></header>
            <form action="/comments" method="post">
            {{csrf_field()}}
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your review on above game"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Comment</button>
              
            </form>
        </div>
    </div>
    
   @foreach($comments as $comment) 
   <h1>{{$comment->body }}</h1>
@endforeach
    

    <div ng-app="Actions">
    <span ng-controller="LikeController">
        @if ($post->user->id != Auth::id())
            <button class="btn btn-default like btn-login" ng-click="like()">
                <i class="fa fa-heart"></i>
                <span>@{{ like_btn_text }}</span>
            </button>
        @endif
    </span>
</div>
<script>
    var app = angular.module("Actions", []);
    app.controller("LikeController", function($scope, $http) {
        
        checkLike();
        $scope.like = function() {
            var post = {
                id: "{{ $post->id }}",
            };
            $http.post('/api/v1/post/like', post).success(function(result) {
                checkLike();
            });
        };
        function checkLike(){
            $http.get('/api/v1/post/{{ $post->id }}/islikedbyme').success(function(result) {
                if (result == 'true') {
                    $scope.like_btn_text = "Delete Like";
                } else {
                    $scope.like_btn_text = "Like";
                }
            });
        };
    });
</script>
</body>

    </html>

