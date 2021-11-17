import React from 'react'
import {
    AppBar,
    Badge,
    Box,
    Button,
    IconButton,
    Toolbar,
  } from "@material-ui/core";
import Divider from "@material-ui/core/Divider";
import ListItemIcon from "@material-ui/core/ListItemIcon";
import Menu from "@material-ui/core/Menu";
import MenuItem from "@material-ui/core/MenuItem";
import Typography from "@material-ui/core/Typography";
import DraftsIcon from "@material-ui/icons/Drafts";
import InputIcon from "@material-ui/icons/Input";
import MenuIcon from "@material-ui/icons/Menu";
import NotificationsIcon from "@material-ui/icons/NotificationsOutlined";
import PriorityHighIcon from "@material-ui/icons/PriorityHigh";
import { useContext, useEffect, useState} from "react";
import { Link, useLocation } from "react-router-dom";

  const DashboardNabar =()=>{

    return(
        <AppBar elevation={0}>
            <Toolbar>
                <a href='/'>
                    logo
                </a>
                <Box sx={{ flexGrow: 1 }} />
                <IconButton color='inherit' >
                    <Badge badgeContent={2} color='secondary'>
                    <NotificationsIcon />
                    </Badge>
                </IconButton>
            </Toolbar>
        </AppBar>
    )

  }
  export default DashboardNabar;