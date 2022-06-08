import React from "react";
import { Outlet, Link } from "react-router-dom";
import host from "../config";

function Layout() {
  const loginURL = host + "/login.php";
  return (
    <>
      <nav className="d-flex justify-content-between px-4 align-items-center">
        <ul>
          <li className="text-primary">
            <h1>TCMS</h1>
          </li>
        </ul>
        <ul>
          <li>
            <Link to="/">Home</Link>
          </li>
          <li>
            <Link to="/about">About</Link>
          </li>
          <li>
            <Link to="/courses">Courses</Link>
          </li>
          <li>
            <Link to="/data">Data</Link>
          </li>
          <li>
            <Link to="/notification">Notification</Link>
          </li>
          <li>
            <a href={loginURL}>Member Page</a>
          </li>
        </ul>
      </nav>
      <Outlet />
    </>
  );
}

export default Layout;
