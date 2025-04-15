import { useRef, useState, useContext, useEffect } from 'react'
import { StoreContext } from '../context/store'
import { Formik, Field, Form, ErrorMessage } from 'formik'
import { useGoogleReCaptcha } from 'react-google-recaptcha-v3'
import ErrorInput from './ErrorInput'
import axios from 'axios'
import { ToastContainer, toast } from 'react-toastify'
import Loader from './Loader'
import { validation, getStores } from './../utils/dataUtils'
import 'react-toastify/dist/ReactToastify.css'

import './formulario.css'

export default function Formulario() {
  const [loading, setLoading] = useState(false)
  const [wordBtn, setWordBtn] = useState('ENVIAR')
  const [stores, setStores] = useState(false)
  const [isSubscribed, setIsSubscribed] = useState(true)
  const { executeRecaptcha } = useGoogleReCaptcha()
  const { message, setMessage } = useContext(StoreContext)

  const ref = useRef()

  const handleChange = event => {
    setIsSubscribed(event.target.checked)
  }

  useEffect(() => {
    ref.current.setFieldValue('comments', message)
  }, [message])

  useEffect(() => {
    getStores(setLoading, axios, setStores, toast)
  }, [])

  const sendForm = async (values, { setSubmitting, resetForm }) => {
    setLoading(true)
    setWordBtn('ENVIANDO...')

    const token = await executeRecaptcha('form_contacto')
    values.recaptchaToken = token

    if (isSubscribed) {
      values.newsletter = 'on'
    } else {
      delete values.newsletter
    }

    values.rubro = import.meta.env.VITE_RUBRO // Nombre del rubro tal cual figura en Perfit
    values.origin = import.meta.env.VITE_NAME_LANDING // Nombre del origin tal cual figura en Perfit
    values.path = import.meta.env.VITE_PATH_LANDING // nombre de carpeta contenedora
    values.interest_number = import.meta.env.VITE_INTEREST_NUMBER // numero del interes tal cual figura en Perfit
    const urlParams = new URLSearchParams(window.location.search)

    if (urlParams.has('utm_source')) {
      values.utm_source = urlParams.get('utm_source')
    } else {
      values.utm_source = 'No Set'
    }

    if (urlParams.has('utm_medium')) {
      values.utm_medium = urlParams.get('utm_medium')
    } else {
      values.utm_medium = 'No Set'
    }

    if (urlParams.has('utm_campaign')) {
      values.utm_campaign = urlParams.get('utm_campaign')
    } else {
      values.utm_campaign = 'No Set'
    }

    if (urlParams.has('utm_content')) {
      values.utm_content = urlParams.get('utm_content')
    } else {
      values.utm_content = 'No Set'
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

    resetForm()
    setMessage('')
    setSubmitting(false)
    setLoading(false)
    setWordBtn('ENVIAR')
  }

  const initFormDefault = {
    name: '',
    email: '',
    phone: '',
    store: true,
    comments: message,
    newsletter: true,
  }

  return (
    <>
      {loading && <Loader />}
      <section className='container formulario'>
        <div className='row'>
          <div className='col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 content_form'>
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

                      <div style={{display: "none"}} className='form-group content_store'>
                        <h4>Seleccioná un showroom de tu preferencia</h4>

                        {stores &&
                          stores.map((item, index) => (
                            <div
                              key={item.id}
                              className='form-check form-check-inline'
                            >
                              <Field
                                id={`input_${item.id}`}
                                checked={item.value}
                                name='store'
                                className='form-check-input'
                                type='radio'
                                value={item.id}
                              />
                              <label
                                className='form-check-label label_radio'
                                htmlFor={`input_${item.id}`}
                              >
                                {item.name}
                              </label>

                              {stores.length === index + 1 && (
                                <ErrorMessage
                                  name='store'
                                  component={ErrorInput}
                                />
                              )}
                            </div>
                          ))}
                      </div>

                      <div className='form-group form-check'>
                        <label>
                          <Field
                            onChange={handleChange}
                            checked={isSubscribed}
                            type='checkbox'
                            name='newsletter'
                            id='newsletter'
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
                        {wordBtn}
                      </button>
                    </Form>
                  )}
                </Formik>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  )
}
