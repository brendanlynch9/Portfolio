import React, { Component } from "react";
// stateless functional component

const Navbar = ({ totalCounters }) => {
  // mounting phase
  console.log("Navbar-Rendered");
  return (
    <nav className="navbar navbar-light bg-light">
      <a className="navbar-brand" href="#">
        Navbar{" "}
        <span className="badge badge-pill badge-secondary">
          {totalCounters}
        </span>
      </a>
    </nav>
  );
};

export default Navbar;
