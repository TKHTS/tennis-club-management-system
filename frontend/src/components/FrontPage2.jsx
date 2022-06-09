import React from "react";
import { useState } from "react";
import $ from "jquery";
import { FaUsers } from "react-icons/fa";
import host from '../config';

function Frontpage2() {
  const [members_number, setCourses] = useState("");

  $.ajax({
    type: "GET",
    url: host + "/api/get_number_users.php",
    success(data) {
      setCourses(data);
    },
  });

  $("#members_number_output").html(members_number);
  return (
    <>
      <div className="container">
        <h1 className="text-primary text-center m-4">
          <FaUsers />
          <span className="p-4">Our Courch and Member</span>
        </h1>
        <div id="members_number_output" className="row py-4 text-center"></div>
      </div>
    </>
  );
}

export default Frontpage2;