
/**
 * Task: Creates an instance of a single cookie with CRUD functionality, provided a path.
 * Mainly will be used for viewing purposes like display name, shopping cart items, adjustments of navigation bar, etc.
 * 
 * To create a cookie which will expire after 30 days:
 * 
 * var cookie_name = 'pontikis_net_js_cookie';
 * var cookie_value = 'test_cookie_created_with_javascript';
 * create_cookie(cookie_name, cookie_value, 30, "/");
 * 
 */
class CookiesHandler {

/**
 * @param {string} path = "/"
 */
   constructor(path) { 
      this.path = path;
    }

    /**
     * Create cookie.
     *
     * @param {string} name cookie name
     * @param {string} value cookie value
     * @param {int} days2expire
     * @param {string} path
     */
    create(name, value, days2expire) {
      var date = new Date();
      date.setTime(date.getTime() + (days2expire * 24 * 60 * 60 * 1000));
      var expires = date.toUTCString();
      document.cookie = name + '=' + value + ';' +
                   'expires=' + expires + ';' +
                   'path=' + this.path + ';';
    }

  /**
   * Retrieve cookie with javascript.
   *
   * @param {string} name cookie name 
   * @return cookie_value || ""
   * 
   * To retrieve a cookie with name "pontikis_net_js_cookie":
   * 
   * var cookie_name = 'pontikis_net_js_cookie';
   * var res = retrieve_cookie(cookie_name);
   * if(res) {
   *    alert('Cookie with name "' + cookie_name + '" value is ' + '"' res + '"');
   * } else {
   *    alert('Cookie with name "' + cookie_name + '" does not exist...');
   * }
   */
    read(name) {
        var cookie_value = "",
        current_cookie = "",
        name_expr = name + "=",
        all_cookies = document.cookie.split(';'),
        n = all_cookies.length;
    
      for (var i = 0; i < n; i++) {
        current_cookie = all_cookies[i].trim();
        if(current_cookie.indexOf(name_expr) == 0) {
          cookie_value = current_cookie.substring(name_expr.length, current_cookie.length);
          break;
        }
      }
      return cookie_value;
  }

  /**
   * Update cookie with javascript.
   *
   * @param {string} value cookie value
   * @param {string} days2expire days before cookie expires
   * 
   */
  update(value, days2expire) {
    this.value = value;
    // if days2expire has a value other than "" assign it else assign it to itself.
    this.days2expire = days2expire != "" ? days2expire : this.days2expire;
    this.create();
  }


  /**
   * Delete cookie.
   */
  delete(name) {
     var past_date = 'Thu, 01 Jan 1970 00:00:00 GMT';
     document.cookie = name + "=; expires="+past_date+"; path=" + this.path;
  }


}
