
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<img id="img">
<script>
           // In this example, if you make an ajax request to the following website
var myUrl = 'https://electoralsearch.in/Home/searchVoter?epic_no=INB0651158&page_no=1&results_per_page=10&reureureired=ca3ac2c8-4676-48eb-9129-4cdce3adf6ea&search_type=epic&state=S22&txtCaptcha=hd2bLn';
 
 
// However to make it work, we are going to use the cors-anywhere free service to bypass this
var proxy = 'https://cors-anywhere.herokuapp.com/';

$.ajax({
    // The proxy url expects as first URL parameter the URL to be bypassed
    // https://cors-anywhere.herokuapp.com/{my-url-to-bypass}
    url: proxy + myUrl,
    complete:function(data){
        console.log(data);
    }
});
                   
</script>

 