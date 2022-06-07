import React from "react";
import { useState } from "react";
import $ from "jquery";
import Video from "../img/Tennis_Court.mp4";
import { FaCalendarCheck, FaChild } from "react-icons/fa";
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

      <div className="container">
        <h1 className="text-primary text-center m-4">
        <FaChild/>
          <span className="p-4">About us</span>
        </h1>
        <div>
          <h2 className="py-4">
            With a full range of course content Lessons tailored to your
            experience level From beginners who pick up a racket for the first
            time to serious players who want to compete and "win! to serious
            players who want to compete and win! Have fun! Our motto is to
            support your tennis life!
          </h2>
        </div>
      </div>
      <div className="container">
        <h1 className="text-primary text-center m-4">
          <FaCalendarCheck />
          <span className="p-4">Our courses</span>
        </h1>
        <div id="courses_output" className="row py-4 text-center"></div>
      </div>
    </>
  );
}

export default Frontpage1;
