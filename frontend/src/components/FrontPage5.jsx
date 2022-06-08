import React from "react";
import { useState } from "react";
import $ from "jquery";
import { FaCalendarCheck} from "react-icons/fa";
import host from '../config';

function Frontpage5() {
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

export default Frontpage5;
