<!--======================== content ===========================-->
<div id="content">
    <div class="container">
        <div class="row">
            <div class="grid_5 m_75">
                <h4>Як знайти нас</h4>
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1261.9513387682944!2d25.383352684657382!3d50.75883823838034!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x472590bac0e64807%3A0x8c756f321b0613e0!2z0LLRg9C7LiDQn9C40YHQsNGA0LXQstGB0YzQutC-0LPQviwgOSwg0JvRg9GG0YzQuiwg0JLQvtC70LjQvdGB0YzQutCwINC-0LHQu9Cw0YHRgtGM!5e0!3m2!1suk!2sua!4v1412602196342" width="600" height="450" frameborder="0" style="border:0"></iframe>
                </div>
            </div>
            <div class="grid_3">

                <h6 class="m_22 m_top_10"><sup>тм</sup> Волинь<br/>ЧП Мельник Сергей Николаевич</h6>
                <address  class="m_21">
                    <dl>
                        <dt>
                            <strong>Юридический адрес:</strong><br>
                            43008 Украина, Волынская обл.,
                            г. Луцк, ул. Писаревского 9/40
                        </dt>
                    </dl>
                </address>
                <address  class="m_21">
                    <dl>
                        <dt>
                            <strong>Адрес производства:</strong><br>
                            45632 Украина, Волынская обл.,
                            Луцкий р-н, с. Змиинец, ул. Лискова, 20
                        </dt>
                    </dl>
                </address>
                <address>
                    <dl>
                        <dd><span> <strong>Телефони</strong></span>+38 (066) 207 07 30</dd>
                        <dd><span>&nbsp;</span>+38 (098) 709 79 76</dd>
                        <dd>E-mail: <a href="mailto:volunpapir@at.ua">volunpapir@at.ua</a></dd>
                    </dl>
                </address>
            </div>
            <div class="grid_4">
                <h4>Звязок із нами</h4>

                <form id="form">

                    <div class="success_wrapper">
                        <div class="success-message">Contact form submitted</div>
                    </div>
                    <label class="name">
                        <input type="text" placeholder="Ваше імя:" data-constraints="@Required @JustLetters" />
                        <span class="empty-message">*This field is required.</span>
                        <span class="error-message">*This is not a valid name.</span>
                    </label>

                    <label class="email">
                        <input type="text" placeholder="E-mail:" data-constraints="@Required @Email" />
                        <span class="empty-message">*This field is required.</span>
                        <span class="error-message">*This is not a valid email.</span>
                    </label>
                    <label class="phone">
                        <input type="text" placeholder="Контактні дані:" data-constraints="@Required @JustNumbers"/>
                        <span class="empty-message">*This field is required.</span>
                        <span class="error-message">*This is not a valid phone.</span>
                    </label>
                    <label class="message">
                        <textarea placeholder="Повідомлення:" data-constraints='@Required @Length(min=20,max=999999)'></textarea>

                        <span class="empty-message">*This field is required.</span>
                        <span class="error-message">*The message is too short.</span>
                    </label>
                    <div>
                        <div class="wrapper">
                            <div class="btns">
                                <a data-type="reset" class="btn resrt">Очистити</a>

                            </div>
                            <div class="btns">
                                <a data-type="submit" class="btn">Надіслати</a>

                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>