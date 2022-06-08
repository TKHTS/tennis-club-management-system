import React from "react";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Layout from "./pages/Layout";
import Home from "./pages/Home";
import Courses from "./pages/Courses";
import Data from "./pages/Data";
import About from "./pages/About";
import Notification from "./pages/Notification";
import NoPage from "./pages/NoPage";

function RouteLayout() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Layout />}>
          <Route index element={<Home />} />
          <Route path="about" element={<About />} />
          <Route path="courses" element={<Courses />} />
          <Route path="data" element={<Data />} />
          <Route path="notification" element={<Notification />} />
          <Route path="" element={<NoPage />} />
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default RouteLayout;