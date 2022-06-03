import React from "react";
import ReactDOM from "react-dom/client";
import Frontpage1 from "./components/Frontpage1";
import FrontPage2 from "./components/FrontPage2";
import FrontPage3 from "./components/FrontPage3";
import "./index.css";
import reportWebVitals from "./reportWebVitals";
import './bootstrap.min.css';

const root = ReactDOM.createRoot(document.getElementById("root"));
root.render(
  <>
  <div className="bg-light main">
    <Frontpage1 />
    <FrontPage2 />
    <FrontPage3 />
  </div>
  </>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
