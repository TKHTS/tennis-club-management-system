import React from "react";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Layout from "./pages/Layout";
import Home from "./pages/Home";
import Data from "./pages/Data";
import Notification from "./pages/Notification";
import NoPage from "./pages/NoPage";

function RouteLayout() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Layout />}>
          <Route index element={<Home />} />
          <Route path="data" element={<Data />} />
          <Route path="notification" element={<Notification />} />
          <Route path="" element={<NoPage />} />
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default RouteLayout;