import React from "react";
import { useState } from "react";
import $ from "jquery";
import Video from "../img/Tennis_Court.mp4";
import host from '../config';

function Frontpage1() {
  const [courses, setCourses] = useState("");

  $.ajax({
    type: "GET",
    url: host + "/api/get_courses.php",
    success(data) {
      setCourses(data);
    },
  });

  $("#courses_output").html(courses);
  return (
    <>
      <div className="video-container">
        <video src={Video} autoPlay playsInline muted loop></video>
        <div className="video-text d-flex align-items-center justify-content-center">
          <h1 className="text-center text-white text-large">
            TCMS / Team CAT
            <br />
            Welcome to our club
          </h1>
        </div>
      </div>
    </>
  );
}

export default Frontpage1;
