class Pages {


   constructor(page, elementToAppendTo) {
      this.page = page;
      this.elementToAppendTo = document.getElementById(elementToAppendTo);
    }



   logPageName() {
      // regular method
      console.log("Page Name: " + this.page);
   }

   get getPageName() {
       return this.page;
   }




   ajaxHandler() {
        //ajax handler
        var post_data = 'page='+this.page; 
        var StateID = this.elementToAppendTo;
        $.ajax({
        type: "POST",
        url: "controllers/router.php", 
        dataType:"text",
        context: StateID,
        data:post_data,
        success:function(response){
            StateID.innerHTML = response;//return php strings of dynamic html, note nothing being returned can have javascript functionality.  Only take to different php pages..

        },
        error:function (xhr, ajaxOptions, thrownError){
            alert("ERROR");
        }
        });
   }
}
