import React from 'react';
import {Outlet, Link} from 'react-router-dom';

function Layout() {
  return (
      <>
      <nav className='d-flex justify-content-between px-4 align-items-center'>
          <ul>
             <li className='text-primary'><h1>TCMS</h1></li>
        </ul>
          <ul>
              <li>
                  <Link to="/">Home</Link>
              </li>
              <li>
                  <Link to="/data">Data</Link>
              </li>
              <li>
                  <Link to="/notification">Notification</Link>
              </li>
          </ul>
      </nav>
      <Outlet />
      </>
  )
}

export default Layout;