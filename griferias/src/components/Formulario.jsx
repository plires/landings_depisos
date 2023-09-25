import { useRef, useState, useContext, useEffect } from 'react'
import { StoreContext } from '../context/store'
import { Formik, Field, Form, ErrorMessage } from 'formik'
import { useGoogleReCaptcha } from 'react-google-recaptcha-v3'
import ErrorInput from './ErrorInput'
import axios from 'axios'
import { ToastContainer, toast } from 'react-toastify'
import 'react-toastify/dist/ReactToastify.css'

import './formulario.css'

export default function Formulario() {
  const [loading, setLoading] = useState(false)
  const { executeRecaptcha } = useGoogleReCaptcha()
  const [isSubscribed, setIsSubscribed] = useState(true)
  const { message, setMessage } = useContext(StoreContext)

  const ref = useRef()

  useEffect(() => {
    ref.current.setFieldValue('comments', message)
  }, [message])

  const handleChange = event => {
    setIsSubscribed(event.target.checked)
  }

  const validation = values => {
    const errors = {}
    if (!values.name) {
      errors.name = 'Ingresá un nombre'
    }
    if (!values.email) {
      errors.email = 'Ingresá tu email'
    } else if (!/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i.test(values.email)) {
      errors.email = 'Ingresá un correo válido'
    }
    if (!values.phone) {
      errors.phone = 'Ingresá un teléfono'
    }
    if (!values.comments) {
      errors.comments = 'Enviá tu consulta'
    }
    return errors
  }

  const sendForm = async (values, { setSubmitting, resetForm }) => {
    setLoading(true)
    console.log(values)

    const token = await executeRecaptcha('form_contacto')
    values.recaptchaToken = token

    if (isSubscribed) {
      values.newsletter = 'on'
    } else {
      console.log('entra')
      delete values.newsletter
    }

    values.rubro = import.meta.env.VITE_RUBRO // Nombre del rubro tal cual figura en Perfit
    values.origin = import.meta.env.VITE_NAME_LANDING // Nombre del origin tal cual figura en Perfit
    values.path = import.meta.env.VITE_PATH_LANDING // nombre de carpeta contenedora
    values.interest_number = import.meta.env.VITE_INTEREST_NUMBER // numero del interes tal cual figura en Perfit
    const urlParams = new URLSearchParams(window.location.search)

    if (urlParams.has('utm_medium')) {
      values.utm_medium = urlParams.get('utm_medium')
    } else {
      values.utm_medium = 'No Set'
    }

    try {
      const res = await axios.post(
        import.meta.env.VITE_ROOT + '/php/process.php',
        values,
      )

      const myJson = JSON.stringify(res.data)
      const responseData = JSON.parse(myJson)

      if (responseData.success) {
        toast.success(responseData.msg_success)

        window.dataLayer.push({
          formLocation: 'form_griferias',
          event: 'send_form_griferias',
        })
        resetForm()
        setMessage('')
      } else {
        responseData.errors.map(error => {
          return toast.error(error)
        })
      }
    } catch (error) {
      // Realizar acciones en caso de error
      toast.error(
        'Aparentemente en este momento no hay conexión con el servidor, por favor intente mas tarde.',
      )
    }

    setSubmitting(false)
    setLoading(false)
  }

  const initFormDefault = {
    name: '',
    email: '',
    phone: '',
    comments: message,
    newsletter: true,
  }

  return (
    <section className='container formulario'>
      <div className='row'>
        <div className='col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 content_form'>
          {loading && <div>Loading component</div>}

          <ToastContainer />

          <div className='row'>
            <div id='formulario' className='col-md-12'>
              <Formik
                innerRef={ref}
                initialValues={initFormDefault}
                validate={validation}
                onSubmit={sendForm}
              >
                {({ handleSubmit, isSubmitting }) => (
                  <Form
                    data-aos='fade-up'
                    id='form_contacto'
                    onSubmit={handleSubmit}
                  >
                    <h2>¡Cotizar ahora!</h2>
                    <h5>
                      Cotizaciones sin cargo, consulta por descuentos
                      disponibles este mes.
                    </h5>

                    <div className='form-group'>
                      <Field
                        className='form-control'
                        type='text'
                        name='name'
                        placeholder='Nombre'
                      />
                      <ErrorMessage name='name' component={ErrorInput} />
                    </div>

                    <div className='form-group'>
                      <Field
                        className='form-control'
                        type='email'
                        name='email'
                        placeholder='Email'
                      />
                      <ErrorMessage name='email' component={ErrorInput} />
                    </div>

                    <div className='form-group'>
                      <Field
                        className='form-control'
                        type='number'
                        name='phone'
                        placeholder='Teléfono'
                      />
                      <ErrorMessage name='phone' component={ErrorInput} />
                    </div>

                    <div className='form-group'>
                      <Field
                        className='form-control'
                        as='textarea'
                        name='comments'
                        rows='4'
                        placeholder='Que necesitás?'
                        value={message}
                        onChange={event => setMessage(event.target.value)}
                      />
                      <ErrorMessage name='comments' component={ErrorInput} />
                    </div>

                    <div className='form-group form-check'>
                      <label>
                        <Field
                          onChange={handleChange}
                          checked={isSubscribed}
                          type='checkbox'
                          name='newsletter'
                        />
                        <label
                          className='form-check-label'
                          htmlFor='newsletter'
                        >
                          Suscribir newsletter
                        </label>
                      </label>
                    </div>

                    <button
                      id='send'
                      className='btn btn-primary transition'
                      type='submit'
                      disabled={isSubmitting}
                    >
                      ENVIAR
                    </button>
                  </Form>
                )}
              </Formik>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
