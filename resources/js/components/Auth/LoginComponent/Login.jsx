import React, { useState } from 'react'
import {
    Box,
    Button,
    Container,
    Grid,
    TextField,
    Typography,
  } from '@material-ui/core'
  
import { useFormik } from 'formik'
// import {useHistory} from "react-router-dom"
import * as Yup from 'yup'
// import { useHistory } from 'react-router-dom'
  
  const Login = () => {
    // const history = useHistory()
    const [loading, setLoading] = useState(false)
    const [message, setMessage] = useState('')
    const formik = useFormik({
        initialValues: {
          email: '',
          password: '',
        },
        validationSchema: LoginSchema,
        onSubmit: (values) => {
          handleSubmit(values)
        }
      })
      const handleSubmit = async (values) => {
        setLoading(true)
        const { email, password } = values
        console.log(email);
        console.log(password)
    
        setLoading(false)
      }
      const LoginSchema = Yup.object().shape({
        email: Yup.string().email('Sai email').required('Trường này là bắt buộc!'),
        password: Yup.string()
          .min(2, 'Quá ngắn!')
          .max(70, 'Quá dài!')
          .required('Trường này là bắt buộc!'),
      })

    return (
      <React.Fragment>
           <Box
        sx={{
          backgroundColor: 'background.default',
          display: 'flex',
          flexDirection: 'column',
          height: '100%',
          justifyContent: 'center',
        }}
      >
        <Container maxWidth='sm'>
          <form onSubmit={formik.handleSubmit} >
            <Box sx={{ mb: 3 }}>
              <Typography
                color='textPrimary'
                textalign='center'
                gutterBottom
                variant='h2'
                mb={5}
              >
                Đăng nhập
              </Typography>
              
              <Box
                sx={{
                  pb: 1,
                  pt: 3,
                }}
              >
               
              </Box>
            </Box>
            <TextField
              value={formik.values.email}
              onChange={formik.handleChange}
              error={formik.touched.email && Boolean(formik.errors.email)}
              helperText={formik.touched.email && formik.errors.email}
              name='email'
              type='email'
              id='email_login'
              autoFocus
              placeholder='Nhập vào email'
              fullWidth
              label='Email'
              margin='normal'
              variant='outlined'
            />
            <TextField
              value={formik.values.password}
              onChange={formik.handleChange}
              error={formik.touched.password && Boolean(formik.errors.password)}
              helperText={formik.touched.password && formik.errors.password}
              name='password'
              type='password'
              id='password_login'
              placeholder='Nhập vào mật khẩu'
              fullWidth
              label='Mật khẩu'
              margin='normal'
              variant='outlined'
            />
            <Box sx={{ py: 2 }}>
              <Button
                color='primary'
                fullWidth
                size='large'
                type='submit'
                variant='contained'
              >
                Đăng nhập
              </Button>
            </Box>
          </form>
        </Container>
      </Box>
      </React.Fragment>
    )
  }
  
  export default Login