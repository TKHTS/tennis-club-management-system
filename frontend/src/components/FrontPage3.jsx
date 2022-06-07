// display the notifications using react
import React from "react";
import { useState } from "react";
import $ from "jquery";
import { FaBell } from "react-icons/fa";
import host from '../config';

function FrontPage3() {
  const [noti, setNoti] = useState("");
  
  // search the notifications data by ajax 
  $.ajax({
    type: "GET",
    url: host + "/api/get_notifications.php",
    success(data) {
      setNoti(data);
    },
  });

  return (
    <>
      <div className="container">
        <h1 className="text-primary text-center m-4">
          <FaBell />
          <span className="p-4">Notifications</span>
        </h1>
        {/* React’s replacement for using innerHTML in the browser DOM */}
        <div className="row py-4 text-center" 
        dangerouslySetInnerHTML={{__html: noti}}>
        </div>
      </div>
    </>
  );
}

export default FrontPage3;
